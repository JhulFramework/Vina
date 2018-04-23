<?php namespace Jhul\Core\UI\Component\Container;


class Container extends \Jhul\Core\UI\Element
{

	private $_parent = NULL;

	private $_childrens = [];

	private $_serializedContent;

	private $_contentScript = '';


	//add child
	public function add( $key, $content = '' )
	{
		//don not call new static(), cyclic redundncy
		$child = (new Element( $key, $content))->setParent($this);
		$child->mStyle(); // childrens must initializ style, to position itself correctly
		$this->_childrens[$key] = $child;
		return $this->_childrens[$key] ;
	}

	public function child($key)
	{
		if( isset($this->_childrens[$key]) )
		{
			return $this->_childrens[$key] ;
		}

		throw new \Exception( 'Child View "'.$key.'" Not Found!' , 1);
	}

	final public function key()
	{
		if( NULL != $this->parent() )
		{
			return $this->parent()->key().'_'.$this->name() ;
		}

		return $this->name() ;
	}

	public function compileContent()
	{

		$content = $this->content();

		if( !empty($this->_childrens) )
		{
			$this->setContent( '' );
		}

		foreach ( $this->_childrens as $child )
		{
			$content .= $child->compileContent();
		}

		if( !empty($this->_mStyle) )
		{
			$content = $this->mStyle()->wrapContent( $content );
		}

		return $content ;
	}

	public function compileStyle()
	{
		$style = parent::compileStyle();


		if(!empty($this->_mStyle))
		{
			$style = $this->mStyle()->toString();
		}

		foreach ( $this->_childrens as $child )
		{
			$style .= $child->compileStyle();
		}

		return $style ;
	}

	public function compileScript()
	{
		return $this->_contentScript ;
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
}
