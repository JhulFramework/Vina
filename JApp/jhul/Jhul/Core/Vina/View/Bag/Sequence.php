<?php namespace Jhul\Core\Vina\View\Bag;



class Sequence extends _Abstract
{

	private $name;

	private $_compiledContent;

	public function setName( $name )
	{
		$this->name = $name;
		return $this ;
	}

	/*
	| @param : OBJECT $child
	*/
	final public function prepend( $child)
	{
		$this->_views = array_reverse($this->_views);

		$this->_addObject( $child->name(), $child );

		$this->_views = array_reverse($this->_views);

		return $this->_views[$child->name()] ;
	}

	public function type()
	{
		return $this->name.'_sequence';
	}

	public function compile()
	{
		$this->_compiledContent = '';

		foreach ( $this->views() as $view)
		{
			$this->_compiledContent .= $this->parent()->_compileSubView($view);
		}
	}


	public function compiledContent()
	{
		return $this->_compiledContent ;
	}

	public function add( $view )
	{
		return $this->_addObject( $view->name(), $view ) ;
	}

}
