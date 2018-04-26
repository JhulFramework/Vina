<?php namespace _modules\main\nodes\mwabyd;

class Page extends \Jhul\Core\Application\Page\_Class
{
	public function makeWebPage()
	{

		$this->getApp()->m()->mapper()->registerView( $this->module()->key(), 'mwabyd', __DIR__.'/res/view' );
		$this->cook( 'mwabyd');
	}
}
