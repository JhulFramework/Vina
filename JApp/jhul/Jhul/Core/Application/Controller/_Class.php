<?php namespace Jhul\Core\Application\Controller;

abstract class _Class
{

	use \Jhul\Core\_AccessKey;

	private $_key ;

	public $statusCode = 200;

	public $ifRefreshWebPage = FALSE;

	private $title ;

	private $_params = [];

	private  $_ifShowPage = FALSE ;

	private $_dataAdapter;

	public function dataAdapter()
	{
		if( empty($this->_dataAdapter) )
		{
			$class  = $this->dataAdapterClass();

			$this->_dataAdapter = new $class;

			$this->_dataAdapter->setTitle( $this->app()->name() );
		}

		return $this->_dataAdapter ;
	}

	public function setTitle( $title )
	{
		return $this->dataAdapter()->setTitle( $title );
	}


	public function set( $key, $value = '' )
	{
		if( is_array($key) )
		{
			foreach ($key as $k => $v)
			{
				$this->set($k, $v);
			}
		}
		else
		{
			$this->_params[$key] = $value;
		}

		return  $this;
	}

	public function params()
	{
		return $this->_params ;
	}

	public function dataAdapterClass()
	{
		return __NAMESPACE__.'\\DataAdapter' ;
	}

	abstract public function makewebPage();

	public function ifShowPage()
	{
		return TRUE === $this->_ifShowPage ;
	}

	public function hasQuery( $key, $value )
	{
		return isset($_GET[$key]) && $value == $_GET[$key] ;
	}

	public function ifUIAccessible()
	{
		return TRUE ;
	}

	public function form()
	{
		return $this->context()->form() ;
	}

	public function showPage( $params = [] )
	{
		foreach ($params as $key => $value)
		{
			$this->set($key, $value);
		}

		$this->_ifShowPage = TRUE;
	}

	public function extractJSON( $source, $params )
	{
		$jObj = new \stdClass;

		foreach ($params as $p)
		{
			$jObj->$p = $source->$p();
		}

		return $jObj ;
	}


	public function extractAndSetJSON( $key, $source, $params )
	{
		$this->set($key, $this->extractJSON($source, $params) );
	}
}
