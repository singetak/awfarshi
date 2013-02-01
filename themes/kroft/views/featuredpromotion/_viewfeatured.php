<li>
	<a class="plusbg" href="<?php echo $data->getUrl(); ?>" title="An image"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/featuredpromotion/image/'.$data->featured_image,"Cover Image",array("width"=>300,"class"=>"promotionCoverImage")); ?></a>
	<div class="thumb-description">
		<span class="thumb-title"><?php echo CHtml::link(CHtml::encode($data->promotion->title), $data->getUrl()); ?></span>
		<p>
		<?php
	     	 $summary = $data->featured_teaser;
		     $limit = 1000;
		     if (strlen($summary) > $limit)
			      $summary = substr($summary, 0, strrpos(substr($summary, 0, $limit), ' ')) . '...';
			 echo $summary;
	     ?>
		</p>
	</div>
</li>