<?php namespace Jhul\Core\Vina\View\Bag;

/*
| after adding subView parent name must no be changed, because subView key will not be in synce with parent
*/

abstract class _Abstract
{
	private $parent ;

	protected $_views = [] ;

	public function __construct( $parent )
	{
		$this->parent = $parent;
	}

	final public function register($name)
	{
		$this->parent()->registerSubView($name, $this->type());
	}

	public function parent()
	{
		return $this->parent ;
	}

	public function name()
	{
		return $this->name ;
	}

	protected final function _initViewObject( $view  )
	{
		$this->register( $view->name(), $this->type() );

		if( $this->parent()->ifBindContent() )
		{
			$view->style()->setParentSelector( $this->parent()->style()->Selector() );
		}

		return $view->setParentKey( $this->parent()->_key() );
	}

	final protected function _addString( $name, $view)
	{
		$this->_views[$name] = $view;
	}

	final protected function _addObject( $name, $view)
	{
		$this->_views[$name] = $this->_initViewObject($view);
		return $this->_views[$name] ;
	}

	public function views()
	{
		return $this->_views ;
	}

	public function get( $name )
	{
		if( isset($this->_views[$name]) )
		{
			return $this->_views[$name] ;
		}

		throw new \Exception( 'subView View "'.$name.'" Not Found!' , 1);
	}

	public final function has( $name = NULL )
	{
		if( !empty($name) )
		{
			return isset($this->_views[$name]) ;
		}

		return !empty($this->_views) ;
	}

	final public function isEmpty()
	{
		return empty($this->_views) ;
	}
}
