<?php namespace _modules\main\nodes\bfoag;

class Page extends \Jhul\Core\Application\Page\_Class
{

	public function makeWebPage()
	{
		$this->title = 'Best Free Offline Android Games';

		$items = require __DIR__.'/res/_items.php';

		$this->getApp()->response()->page()->meta()->add( 'description' , 'This is the list of free android games which can be played offline' );
		$this->getApp()->response()->page()->meta()->add( 'robots' , 'all' );

		$this->getApp()->m()->mapper()->registerView( $this->module()->key(), 'bfoag', __DIR__.'/res/view' );

		$this->cook( 'bfoag', ['items' =>  $items ]);
	}
}
