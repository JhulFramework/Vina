<?php namespace Jhul\Core\Vina\View\Bag;


class Fragment extends _Abstract
{

	private $_compiled = [];



	public function type()
	{
		return 'fragment' ;
	}


	//@returns : array of views
	public function compile()
	{
		foreach ( $this->views() as $name => $view)
		{
			if( is_object($view) )
			{
				$view = $this->parent()->_compileSubView($view);
			}

			$this->_compiled[$name] = $view;
		}
	}

	public function compiled()
	{
		return $this->_compiled;
	}

	public function add( $view, $content = '' )
	{
		if( is_object($content) )
		{
			throw new \Exception( 'Second Param MUst Not be an object' , 1);
		}

		if( is_object($view) )
		{
			return $this->_addObject( $view->name(),  $view) ;
		}

		$this->_addString(  $view,  $content );

	}
}
