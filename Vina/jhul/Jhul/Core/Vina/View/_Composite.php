<?php namespace Jhul\Core\Vina\View;


/*
| after adding subView parent name must no be changed, because subView key will not be in synce with parent
*/

trait _Composite
{

	private $_sharedStyle;

	private $_subViewRegister ;

	private $_sequenceViewBag = [];


	public function _initComposite()
	{
		$this->_sharedStyle = new Bag\SharedStyle($this);
		$this->_sequenceViewBag = (new Bag\Sequence($this))->setName('default');

	}

	public function prependView( $view, $content = '' )
	{
		return $this->viewBag()->prepend( $this->_initChild( $view, $content = '' ) );
	}

	//add child
	private function _initChild( $child, $content = '' )
	{
		if( is_object($content) )
		{
			throw new \Exception( 'second parameter must not be an Object' , 1);
		}

		if( is_string($child) )
		{
			return $this->objectifyChild( $child, $content );
		}

		return $child ;
	}

	abstract public function objectifyChild( $name, $content );

	final protected function addView(  $view, $content = '' )
	{
		return $this->viewBag()->add( $this->_initChild( $view, $content ) );
	}

	final public function registerSubView($name, $type)
	{
		if( isset($this->_subViewRegister[$name]) && $type != $this->_subViewRegister[$name] )
		{
			throw new \Exception( 'subView view name "'.$name.'" is aready used by "'.$this->_subViewRegister[$name].'" ' , 1);
		}

		$this->_subViewRegister[ $name ] = $type;
	}


	public function viewBag(){ return $this->_sequenceViewBag ; }

	final public function compileComposite()
	{
		$this->_sharedStyle->compile();

		$this->viewBag()->compile();
	}

	public function createSubStyle($name)
	{
		return $this->_sharedStyle->create($name);
	}

	public function subStyle( $name )
	{
		return $this->_sharedStyle->get($name);
	}

	public function hasSubStyle( $name )
	{
		return $this->_sharedStyle->has($name);
	}

}
