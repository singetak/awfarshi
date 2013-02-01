<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<!-- Front slider -->
<div id="front-slides">
	<div class="slides_container">
		<?php 
		$data = $featuredPromotionDataProvider->getData();
		foreach($data as $i => $item){
			Yii::app()->controller->renderPartial('_viewfeatured',array('index' => $i, 'data' => $item, 'widget' => $this));
		}
		?>
	</div>
	<div id="front-slides-cover"></div>
		
	<!-- Headline -->
	<div id="headline"><h6></h6></div>
	<!-- ENDS Headline -->	

</div>
<!-- ENDS Front slider -->
<!-- Latest Promotions -->
<div class="featured-title">
	<div class="ribbon"><span>Latest Promotions</span></div>
</div>
<ul class="featured-posts">
	<?php 
	$data = $promotionDataProvider->getData();
	foreach($data as $i => $item){
		Yii::app()->controller->renderPartial('_viewpromotions',array('index' => $i, 'data' => $item, 'widget' => $this));
	}
	?>
</ul>
<div class="clear"></div>
<!-- ENDS Latest Promotions -->
