<?php namespace Jhul\Core\Vina\View\Bag;


/*
| after adding subView parent name must no be changed, because subView key will not be in synce with parent
*/

class SharedStyle extends _Abstract
{

	public function type()
	{
		return 'sharedStyle' ;
	}

	public function create( $name )
	{
		$style = new \Jhul\Core\Vina\View\Element($name) ;
		return $this->_addObject( $style->name(), $style ) ;
	}

	public function compile()
	{
		foreach ( $this->views() as $view)
		{
			$this->parent()->_compileSubView($view);
		}
	}

}
