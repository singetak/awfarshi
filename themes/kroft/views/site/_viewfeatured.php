<?php
/* @var $this FeaturedPromotionController */
/* @var $data FeaturedPromotion */
?>
<div class="slide">
	<a href="<?php echo $data->getUrl(); ?>" target="blank"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/featuredpromotion/image/'.$data->featured_image,"Cover Image",array("width"=>940,"height"=>360,"class"=>"promotionCoverImage")); ?></a>
	<div class="caption"><?php echo CHtml::link(CHtml::encode($data->promotion->title), $data->getUrl()); ?></div>
</div>