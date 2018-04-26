<?php namespace Jhul\Component\Event;

/*
+=======================================================================================================================
|@Created : 2018 April 01
+----------------------------------------------------------------------------------------------------------------------*/

class Event
{

	use \Jhul\Core\Design\Component\_Trait;

	const SYS_STORE_DIR_NAMESPACE = '_component/event';

	private $map = [];

	public function registerListener( $key, $listenerClass = NULL )
	{
		if( is_array($key) )
		{
			foreach ($key as $k => $l)
			{
				if( !in_array($l, $this->getListeners($k) ) )
				{
					$this->getListeners($k)[]  =  $l ;
				}
			}
		}
		else
		{
			if( !in_array($l, $this->getListeners($k) ) )
			{
				$this->getListeners($key)[] = $listenerClass;
			}
		}

		$this->commitMap();
	}

	public function commitMap()
	{
		foreach ( $this->_map as $key => $listeners )
		{
			$this->sysFileStore()->saveConfig( $listeners, $this->mapPath($key) );
		}
	}

	private function mapPath( $key )
	{
		return static::SYS_STORE_DIR_NAMESPACE.'/'.str_replace('#', '/', $key);
	}

	public function trigger( $key, $params = [] )
	{
		foreach ( $this->getListeners($key) as  $listenerClass )
		{
			(new $listenerClass($params))->setKey($key)->handle($params);
		}
	}

	public function &getListeners($key)
	{
		if( !isset($this->_map[$key]) )
		{
			$this->_map[$key] = $this->loadMap($key);
		}

		return $this->_map[$key] ;
	}

	private function loadMap( $key )
	{
		return  $this->sysFileStore()->readConfig( $this->mapPath($key) );
	}

	public function sysFileStore()
	{
		return $this->j()->mSysFileStore() ;
	}
}
