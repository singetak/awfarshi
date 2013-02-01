<ul>
	<li><?php echo CHtml::link('Create New Post',array('post/create')); ?></li>
	<?php if(Yii::app()->user->isAdmin()): ?>
		<li><?php echo CHtml::link('Manage Posts',array('post/admin')) . ' (' . Posts::model()->draftPostsCount . ')'; ?></li>
		<li><?php echo CHtml::link('Approve Comments',array('comments/index')) . ' (' . Comments::model()->pendingCommentCount . ')'; ?></li>
		<li><?php echo CHtml::link('Create New User',array('users/create')); ?></li>
		<li><?php echo CHtml::link('Manage Users',array('users/admin')); ?></li>
	<?php endif; ?>
</ul>