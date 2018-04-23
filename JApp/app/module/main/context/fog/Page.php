<?php namespace _modules\main\nodes\bfoag;

class Page extends \Jhul\Core\Application\Page\_Class
{

	public function makeWebPage()
	{
		$this->title = 'Free Offline PC Games';

		$this->getApp()->response()->page()->meta()->add( 'description' , 'This is the list of free PC games which can be played offline' );
		$this->getApp()->response()->page()->meta()->add( 'robots' , 'all' );

		$this->getApp()->m()->mapper()->registerView( $this->module()->key(), 'fog', __DIR__.'/res/view' );

		$this->cook( 'fog');
	}
}
