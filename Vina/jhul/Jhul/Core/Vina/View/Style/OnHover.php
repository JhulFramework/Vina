<?php namespace Jhul\Core\Vina\View\Style;


class OnHover extends _Composer
{
	use Param\_API;

	public function compileHoverStyle()
	{

		return $this->selector().':hover{'.$this->_compileStyle().'}' ;
	}

	public function compile()
	{
		return $this->compileHoverStyle() ;
	}

	public function selector()
	{
		return $this->viewObject()->selector() ;
	}
}
