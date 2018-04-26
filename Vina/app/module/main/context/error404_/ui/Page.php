<?php namespace _m\main\context\error404_\ui;

class Page extends \Jhul\Core\UI\Page\_Class
{
	public function ifEnableIndexing()
	{
		return FALSE ;
	}

	public function generate()
	{
		$this->setFragment('pageContent', new Layout('error404'));
	}

	public function layout()
	{
		return 'layout' ;
	}
}
