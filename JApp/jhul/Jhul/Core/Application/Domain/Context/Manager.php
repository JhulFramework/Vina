<?php namespace Jhul\Core\Application\Domain\Context;

/* @Author : Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Created : 2017OCT14
| @Updated : 2018JAN15
+---------------------------------------------------------------------------------------------------------------------*/

class Manager
{
	//private $_domainKey;

	private $_domainKey;

	public function __construct( $domainKey )
	{
		$this->_domainKey =  $domainKey;
	}

	private function domainKey()
	{
		return $this->_domainKey ;
	}

	public function get( $contextKey )
	{
		if( 0 !== strpos( $contextKey, $this->domainKey() ) )
		{
			$contextKey = $this->domainKey().$contextKey;
		}

		if( isset( $this->_loaded[$contextKey] ) )
		{
			return $this->_loaded[$contextKey] ;
		}

		if( NULL != ( $class = $this->app()->mapper()->getContextClass( $contextKey, FALSE ) ) )
		{
			$this->_loaded[$contextKey] = new $class( $contextKey, str_replace( $this->_domainKey, '', $contextKey  ) ) ;
		}

		if( isset($this->_loaded[$contextKey]) )
		{
			return $this->_loaded[$contextKey] ;
		}

		throw new \Exception( 'Context "'.$contextKey.'" Not Found! ' , 1);
	}

	public function getByNamespace( $namespace )
	{
		$pos = strrpos( $namespace, '_\\' );

		$rContext = substr( $namespace, 0, $pos+1 ).'\\Context';

		$key = array_search( $rContext, $this->mapper()->contextMap() );

		if( $key )
		{
			return $this->get($key) ;
		}

		throw new \Exception( 'Context Not Defined For Class "'.$namespace.'"' , 1);
	}

	public function app()
	{
		return \Jhul::I()->app();
	}

	public function mapper()
	{
		return \Jhul::I()->app()->mapper();
	}
}
