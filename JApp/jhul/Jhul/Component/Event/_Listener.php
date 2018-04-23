<?php namespace Jhul\Component\Event;

abstract class _Listener
{
	use \Jhul\Core\_AccessKey;

	private $_key;

	abstract public function handle( $params );

	public final function setKey( $key )
	{
		$this->_key = $key;
		return $this ;
	}

	public final function key()
	{
		return $this->_key ;
	}
}
