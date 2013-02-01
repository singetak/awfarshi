<h6 class="side-title">Categories</h6>
<ul class="cat-list">
	<?php foreach($this->getRecentCategories() as $category): ?>
	<li>
		<?php echo CHtml::link(CHtml::encode($category->name), $category->name); ?>
	</li>
	<?php endforeach; ?>
</ul>