<?php namespace Jhul\Core\Vina\View\Style;


abstract class _Composer
{

	private $_boxShadow ;
	private $_border ;
	private $_paramBag ;

	//style selector name full
	private $_selector;

	//local style name or tag name
	private $_name;

	private $_viewObject;

	abstract public function selector();

	public function __construct( $viewObject )
	{
		$this->_viewObject = $viewObject;
		$this->_paramBag = new Param\_Bag ;
	}

	public function viewObject()
	{
		return $this->_viewObject ;
	}

	final public function paramBag()
	{
		return $this->_paramBag ;
	}

	public function _compileStyle()
	{
		$style = '';
		if( !empty($this->_boxShadow) )
		{
			$style .= $this->_boxShadow->compile();
		}

		if(!empty($this->_border))
		{
				$style .= $this->_border->compile();
		}

		return  $this->paramBag()->compile().$style ;
	}

	public function compileStyle()
	{
		return  $this->selector().'{'.$this->_compileStyle().'}' ;
	}

	public function shadow()
	{
		if( empty($this->_boxShadow) )
		{
			$this->_boxShadow = new Shadow;
		}

		return $this->_boxShadow;
	}

	public function border()
	{
		if( empty($this->_border) )
		{
			$this->_border = new Border;
		}

		return $this->_border;
	}

}
