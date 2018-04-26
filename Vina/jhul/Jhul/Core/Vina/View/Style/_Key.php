<?php namespace Jhul\Core\Vina\View\Style;


trait _Key
{

	private $_selectorKey;
	private $_parentSelector;

	public function setParentSelector( $selector)
	{
		$this->_parentSelector = $selector;
		return $this ;
	}

	public function selector()
	{
		if( !empty($this->_parentSelector) )
		{
			return $this->_parentSelector.' '.$this->selectorLocal() ;
		}

		return $this->selectorLocal() ;
	}

	public function selectorLocal()
	{
		return  '.'.$this->selectorKey();
	}

	public function selectorKey()
	{
		if(empty($this->_selectorKey))
		{
			$this->_selectorKey = $this->viewObject()->generateStyleSelectorKey();
		}

		return $this->_selectorKey ;
	}

	// public function embed()
	// {
	// 	if( strlen( $this->compiledStyle() ) > 8 )
	// 	{
	// 		return '<style>'.$this->compiledStyle().'</style>' ;
	// 	}
	// }

}
