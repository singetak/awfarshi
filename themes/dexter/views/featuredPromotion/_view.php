<?php
/* @var $this FeaturedPromotionController */
/* @var $data FeaturedPromotion */
?>

<div class="view">
	<div class="viewHead clearfix">
		<h4><?php echo CHtml::link(CHtml::encode($data->promotion->title), $data->getUrl()); ?></h4>
		<div class="datetime"><?php echo $data->start_date; ?></div>
	</div>
	<?php //echo CHtml::encode($data->body); ?>
	<div class="viewBody clearfix">
		<?php 
			if($data->featured_image != '')
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/featuredpromotion/image/'.$data->featured_image,"Cover Image",array("width"=>300,"class"=>"promotionCoverImage")); // Image shown here if page is update page 
	     ?>  
	     <?php
	     	 $summary = $data->featured_teaser;
		     $limit = 1000;
		     if (strlen($summary) > $limit)
			      $summary = substr($summary, 0, strrpos(substr($summary, 0, $limit), ' ')) . '...';
			 echo $summary;
	     ?>
	</div>
</div>
<hr>