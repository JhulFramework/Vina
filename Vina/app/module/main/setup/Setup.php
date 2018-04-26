<?php namespace _m\main\setup;

class Setup extends \Jhul\Core\Application\Domain\_Setup
{

	public function install()
	{

	}

	public function dbSchemaVersion()
	{
		return 1 ;
	}


	public function dbTablePrefix()
	{
		return 'jSys';
	}

}
