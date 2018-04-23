<?php namespace Jhul\Core\UI\SuperLayout;

/* @Author : Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Created : 2018JAN06
+---------------------------------------------------------------------------------------------------------------------*/

class Script
{

	private $_linked = [];

	private function touchURL( $url )
	{
		return  !strrpos( $url, '.js' ) ? $url.'.js' : $url ;
	}

	public function add( $name, $url )
	{
		$this->_linked[$name] = $this->_add( $url );
		return $this ;
	}

	public function _add( $url )
	{
		if( is_array($url) )
		{
			return '<script'.$this->createURLFromParam($url).'></script>' ;
		}

		return '<script src="'.$this->touchURL($url).'"></script>' ;
	}

	public function compile()
	{
		return implode( '', $this->_linked );
	}

	public function createURLFromParam( $p )
	{
		$u = '';

		if( isset($p['url']) )
		{
			$u .= ' src = "'.$this->touchURL($p['url']).'"';

			unset($p['url']);
		}

		foreach ($p as $key => $value)
		{
			$u .= ' '.$key.' = "'.$value.'"';
		}

		return $u ;
	}
}
