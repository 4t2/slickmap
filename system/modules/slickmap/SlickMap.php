<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Lingo4you 2011
 * @author     Mario Müller <http://www.lingo4u.de/>
 * @package    PageTeaser
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

class SlickMap extends ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_slickmap';
	protected $rootPage, $homePage;

	public function generate()
	{
		if (!empty($GLOBALS['SLICKMAP']['CSS']))
		{
			$GLOBALS['TL_CSS'][] = $GLOBALS['SLICKMAP']['CSS'];
		}

		return parent::generate();
	}


	/**
	 * Generate content element
	 */
	protected function compile()
	{
		global $objPage;
		
		$utilityPages = deserialize($this->slickmap_utility_pages);
		$primaryRoot = deserialize($this->slickmap_root);

		$this->rootPage = $this->getRootPage($objPage->id);

		$objUtilityPages = $this->Database->prepare("SELECT * FROM tl_page WHERE `id` IN (".implode(',', $utilityPages).")")->execute();

		$utilityNav = array();

		while ($objUtilityPages->next())
		{
			$link = '';

			if ($this->rootPage && ($objPage->domain != $this->rootPage['dns']))
			{
				$link = 'http://' . $this->rootPage['dns'] . '/';
			}
			
			if ($objUtilityPages->type != 'root')
			{
				$link .= $this->generateFrontendUrl($objUtilityPages->row());
			}

			$utilityNav[$link] = $objUtilityPages->title;
		}

		if ($primaryRoot == '')
		{
			$primaryRoot = $this->rootPage['id'];
		}

		if (($primaryPages = $this->getPageTree($primaryRoot)) !== false)
		{
			if ($this->slickmap_columns == 'auto')
			{
				$slickmapColumns = max(1, min(10, count($primaryPages)-1));
			}
			else
			{
				$slickmapColumns = $this->slickmap_columns;
			}
			
			$this->homePage = $this->getRootPage($primaryPages[0]['id']);

			$primaryHtml = $this->getHtmlList($primaryPages, ' id="primaryNav" class="col'.$slickmapColumns.'"', ' id="primaryHome"');
		}
		else
		{
			$primaryHtml = '';
		}

		$this->Template->utilityNav = $utilityNav;
		$this->Template->primaryList = $primaryHtml;
		#$this->Template->debug = var_export($primaryPages, true);
	}


	/**
	 * gets the root page of the current page
	 */
	protected function getRootPage($pageId)
	{
		$type = null;

		// Get all pages up to the root page
		do
		{
			$objPages = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")->limit(1)->execute($pageId);

			$type = $objPages->type;
			$pageId = $objPages->pid;
		}
		while ($objPages->numRows && $pageId > 0 && $type != 'root');

		if ($type == 'root')
		{
			return $objPages->row();
		}
		else
		{
			return false;
		}
	}


	/**
	 * gets page tree
	 */
	protected function getPageTree($pageId)
	{
		$objPages = $this->Database->prepare("SELECT * FROM tl_page WHERE `id`=?")->limit(1)->execute($pageId);

		if ($objPages->numRows > 0)
		{
			$arrPages = array_merge(
				array($objPages->row()),
				$this->getChildPages($pageId, 1)
			);
		}
		else
		{
			$arrPages = false;
		}

		return $arrPages;
	}


	/**
	 * gets all child pages
	 */
	protected function getChildPages($pageId, $level=1)
	{
		$arrPages = array();

		$objPages = $this->Database->prepare("SELECT * FROM `tl_page` WHERE `pid`=? AND `published`='1' AND `hide`<>'1' AND `type`='regular' ORDER BY `sorting`")->execute($pageId);

		while ($objPages->next())
		{
			$arrPage = $objPages->row();
			$arrPage['childs'] = array();

			if ($this->slickmap_articles == '1')
			{
				$arrPage['childs'] = $this->getArticles($arrPage);
			}

			if ($arrPage['type'] != 'root')
			{
				$arrPage['link'] = $this->generateFrontendUrl($arrPage);
			}

			if (($this->slickmap_stop_level == 0) || ($level < $this->slickmap_stop_level))
			{
				if (count($arrPage['childs']) > 0)
				{
					$arrPage['childs'] = array_merge($arrPage['childs'], $this->getChildPages($arrPage['id'], $level+1));
				}
				else
				{
					$arrPage['childs'] = $this->getChildPages($arrPage['id'], $level+1);
				}
			}

			$arrPages[] = $arrPage;
		}

		return $arrPages;
	}


	/**
	 * get articles if more than one article exists
	 */
	protected function getArticles($arrPage)
	{
		$objArticles = $this->Database->prepare("SELECT * FROM `tl_article` WHERE `pid`=? AND `published`='1' ORDER BY `sorting`")->execute($arrPage['id']);
		$arrArticles = array();

		if ($objArticles->numRows > 1)
		{
			while ($objArticles->next())
			{
				$arrArticle = $objArticles->row();

				$link = '/articles/';

				if ($objArticles->inColumn != 'main')
				{
					$link .= $objArticles->inColumn . ':';
				}
		
				$link .= ((strlen($objArticles->alias) && !$GLOBALS['TL_CONFIG']['disableAlias']) ? $objArticles->alias : $objArticles->id);
				
				$arrArticle['link'] = $this->generateFrontendUrl($arrPage, $link);

				$arrArticles[] = $arrArticle;
			}
		}
		
		return $arrArticles;
	}

	/**
	 * get html list
	 */
	protected function getHtmlList($arrPages, $ulParam = false, $liParam = false)
	{
		$html = '<ul'.($ulParam?$ulParam:'').'>';

		foreach ($arrPages as $arrPage)
		{
			if (($linkTitle = strrchr($arrPage['alias'], '/')) === FALSE)
			{
				$linkTitle = $arrPage['alias'];
			}

			if (($this->homePage['dns'] != '') && ($this->homePage['dns'] != $this->rootPage['dns']))
			{
				$arrPage['link'] = 'http://' . $this->homePage['dns'] . '/' . $arrPage['link'];
			}
			else
			{
				$arrPage['link'] = '/' . $arrPage['link'];
			}

			$html .= '<li'.($liParam?$liParam:'').'><a href="'.$arrPage['link'].'" title="'.$linkTitle.'">'.$arrPage['title'].'</a>';

			if (count($arrPage['childs']) > 0)
			{
				$html .= $this->getHtmlList($arrPage['childs']);
			}
			
			$html .= '</li>';
			$liParam = false;
		}

		$html .= '</ul>';
		
		return $html;
	}


	protected function generateAbsoluteLink($arrPage)
	{
		if ($arrPage['domain'] != $this->rootPage['dns'])
		{
			$link = 'http://' . $this->rootPage['dns'] . '/';
		}
		else
		{
			$link = '';
		}
		
		if ($arrPage['type'] != 'root')
		{
			$link .= $this->generateFrontendUrl($arrPage);
		}
		
		return $link;
	}

}

?>