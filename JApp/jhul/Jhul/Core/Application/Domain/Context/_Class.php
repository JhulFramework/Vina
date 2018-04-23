<?php namespace Jhul\Core\Application\Domain\Context;

/*
| @Author : Manish Dhruw
+=======================================================================================================================
| @Created : 2017-Jul-18
| @Updated : [2017-Aug-30]
+---------------------------------------------------------------------------------------------------------------------*/

abstract class _Class
{
	use \Jhul\Core\_AccessKey;

	//used for dirNamespace
	private $_name;

	private $_key;

	private $_namespace;

	private $_form;

	private $_webPage;

	private $_controller;

	private $_resourceKey = 'main' ;

	public function __construct( $key, $name )
	{
		$this->_key = $key;
		$this->_name = $name;
		$this->_namespace = $this->j()->fx()->rchop(get_called_class());
	}

	final public function _namespace()
	{
		return $this->_namespace ;
	}

	public function controllerClass()
	{
		return $this->_namespace().'\\Controller';
	}

	public function webPageClass()
	{
		return $this->_namespace().'\\ui\\Page';
	}

	public function formClass()
	{
		return $this->_namespace().'\\Form';
	}


	public function form()
	{
		if( empty($this->_form) )
		{
			$formClass = $this->formClass();
			$this->_form = new $formClass();
		}

		return $this->_form ;
	}

	public function name()
	{
		return $this->_name ;
	}

	public function key()
	{
		return $this->_key ;
	}

	abstract public function isAccessible();

	public function handle()
	{
		if($this->isAccessible())
		{
			$this->app()->response()->page()->setContext( $this );
		}
	}

	public function controller()
	{
		if( empty($this->_controller) )
		{
			$class = $this->controllerClass();

			$this->_controller = new $class;
		}

		return $this->_controller ;
	}

	public function isAccessibleBySU()
	{
		return $this->app()->su()->canAccessContext( $this->module()->key(), $this->name() ) ;
	}

	public function webPage()
	{
		if( empty($this->_webPage) )
		{
			$class = $this->webPageClass();
			$this->_webPage = new $class($this->resourceKey());
		}

		return $this->_webPage ;
	}

	final public function _dirNamespace()
	{
		return $this->_d()->_dirnamespace().'/'.$this->name() ;
	}

	public function setResourceKey( $key )
	{
		return  $this->_resourceKey = $key;
	}

	public function resourceKey()
	{
		return $this->_resourceKey ;
	}

}
