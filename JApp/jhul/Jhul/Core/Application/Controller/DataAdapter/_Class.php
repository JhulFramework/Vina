<?php namespace Jhul\Core\Application\Controller\DataAdapter;

abstract class _Class
{
	private $_data = [];

	public function setTitle( $title )
	{
		return $this->set( 'title', $title );
	}

	public function get( $key, $required = TRUE )
	{
		if( isset($this->_data[$key]) )
		{
			return $this->_data[$key] ;
		}

		if( $required )
		{
			throw new \Exception( 'Data "'.$key.'" Not Set' , 1);
		}
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
			$this->_data[$key] = $value;
		}

		return  $this;
	}

	public function data()
	{
		return $this->_data ;
	}

	public function title(){ return $this->get('title') ; }

	public function metaTags(){}

	public function compile()
	{

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
