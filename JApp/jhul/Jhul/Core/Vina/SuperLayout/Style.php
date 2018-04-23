<?php namespace Jhul\Core\UI\SuperLayout;


/* @AUTHOR Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Created : [2018JAN06]
+---------------------------------------------------------------------------------------------------------------------*/

class Style
{

	// public accessible linked css files
	private $_linked = [];

	public function add( $name, $url )
	{
		if( !strrpos( $url, '.css' ) ) $url = $url.'.css' ;
		$this->_linked[$name] = '<link href="'.$url.'" rel="stylesheet" type="text/css" />' ;
		return $this ;
	}

	public function compile()
	{
		return implode( '', array_reverse($this->_linked) );
	}

	public function addGoogleFont( $name )
	{
		$this->_linked[$name] =  '<link href="https://fonts.googleapis.com/css?family='.$name.'" rel="stylesheet" type="text/css" />';
		return $this ;
	}

	public function map()
	{
		return $this->_linked ;
	}
}
