<?php

Yii::import('zii.widgets.CPortlet');

class RecentCategories extends CPortlet
{
	public $title='Categories';

	public function getRecentCategories()
	{
		return Category::model()->findRecentCategories();
	}

	protected function renderContent()
	{
		$this->render('RecentCategories');
	}
}