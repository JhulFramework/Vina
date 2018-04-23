<?php namespace Jhul\Core\Vina\View;


/*
| after adding subView parent name must no be changed, because subView key will not be in synce with parent
*/

trait _HasVariable
{
	//css variables
	private $_styleVariables = [];

	//js variable
	private $_scriptVariables = [];


	public function setVariable( $key, $value )
	{
		return $this->setStyleVariable( $key, $value )->setScriptVariable( $key, $value );
	}

	public function setStyleVariable( $key, $value )
	{
		$this->_styleVariables[$key] = $value;
		return $this ;
	}

	public function setScriptVariable( $key, $value )
	{
		$this->_scriptVariables[$key] = $value;
		return $this ;
	}

	final public function styleVariables()
	{
		return $this->_styleVariables ;
	}

	final public function scriptVariables()
	{
		return $this->_scriptVariables ;
	}

}
