<div class="<?php echo $this->class; ?> slickmap block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>

<div class="sitemap">

<?php if ($this->headline): ?>
<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<?php if ($this->utilityNav): ?>
<ul id="utilityNav">
<?php foreach ($this->utilityNav as $link => $title): ?>
	<li><a href="<?php echo $link; ?>"><?php echo $title; ?></a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

<?php echo $this->primaryList; ?>

</div>

</div>