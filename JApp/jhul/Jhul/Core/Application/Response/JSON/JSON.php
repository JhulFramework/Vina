<?php namespace Jhul\Core\Application\Response\JSON;

//TODO Cache JSON Response for static pages

class JSON
{
	use \Jhul\Core\_AccessKey;

	private $_responseContext;

	private static $_data;

	public function __construct()
	{
		static::$_data = new \stdClass();

		$this->cook('ifLoggedIn', !$this->app()->user()->isAnon() );
	}

	public function cook( $key, $value = '' )
	{

		if( is_array( $key ) )
		{
			foreach ($key as $k => $v)
			{
				$this->cook( $k, $v );
			}

			return ;
		}


		static::$_data->$key = $value;
	}

	public function type(){ return 'json'; }


	public function isEmpty()
	{
		return empty( static::$_data );
	}

	public function make()
	{
		if( !empty( $this->_responseContext ))
		{
			$this->_responseContext->controller()->makeJSON();

			$this->app()->response()->setStatusCode( $this->_responseContext->controller()->statusCode );


			foreach ( $this->_responseContext->controller()->params()  as $key => $value)
			{
				static::$_data->$key = $value;
			}
		}


		return json_encode( static::$_data );
	}


	public function contentTypeHeader()
	{
		return 'application/json';
	}

	public function setContext( $context )
	{
		$this->_responseContext = $context;
		return $this ;
	}
}
