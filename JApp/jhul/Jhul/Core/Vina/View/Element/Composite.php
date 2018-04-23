<?php namespace Jhul\Core\Vina\View\Element;


class Composite extends \Jhul\Core\Vina\View\Element
{

	use \Jhul\Core\Vina\View\_Composite;

	private $_url;

	private $_parent = NULL;

	private $_children ;

	public function __construct( $name )
	{
		parent::__construct($name);
		$this->_initComposite();
	}

	public function prependChild( $child, $content = '' )
	{
		return $this->prependView( $child, $content );
	}

	//add child
	protected function objectifyChild( $name, $content )
	{
		return (new Composite( $name))->setContent($content)->setParent($this) ;
	}

	//add child
	public function addChild( $child, $content = '' )
	{
		return $this->addView( $child, $content ) ;
	}


	protected function compileContent()
	{
		if( !$this->viewBag()->isEmpty() )
		{
 			return $this->viewBag()->compiledContent() ;
		}

		return parent::compileContent();
	}

	public function parent()
	{
		return $this->_parent ;
	}

	public function setParent( $parent )
	{
		$this->_parent = $parent;
		return $this ;
	}

	public function child($name)
	{
		return $this->viewBag()->get($name) ;
	}

	public function beforeCompile()
	{
		$this->compileComposite();
		parent::beforeCompile();
	}


}
