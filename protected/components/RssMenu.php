<?php

Yii::import('zii.widgets.CPortlet');

class RssMenu extends CPortlet
{
	public $title="Rss Links";
	
	protected function renderContent()
	{
		$this->render('rssMenu');
	}
}