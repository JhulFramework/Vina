<?php namespace app\user;

class DataCache
{

	use \Jhul\Core\_AccessKey;

	public function setAvatar( $relativePath )
	{
		return $this->set('avatar', $this->mDataType('avatar')->url($relativePath) );
	}


	public function setName( $name )
	{
		return $this->set('name', $name );
	}


	public function avatar()
	{
		return $this->get('avatar');
	}

	public function set( $key, $value )
	{
		$this->app()->user()->setSate( $key, $value );
		return $this ;
	}


	protected function get( $key )
	{
		return $this->app()->user()->getState( $key );
	}

}
