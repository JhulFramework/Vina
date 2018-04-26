<?php namespace Jhul\Core\Application\Domain;

/* @Author Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Created : 12017-Oct-07
| @Updated : [12018OCT15, 12018FEB17]
+---------------------------------------------------------------------------------------------------------------------*/

abstract class _Setup
{

	public static function I( $module )
	{
		return new static( $module) ;
	}

	public function J()
	{
		return \Jhul::I();
	}

	public function __construct( $module )
	{
		$this->dbSchema = $this->j()->fx()->loadConfigFile
		(
			$this->j()->fx()->dirPath( get_called_class() ).'/db/v'.$this->dbSchemaVersion().'/_schema', true, ['module' => $module ]
		) ;
	}

	public function db()
	{
		return  \Jhul::I()->cx('dbm')->getDB();
	}

	public function app()
	{
		return \Jhul::I()->app();
	}

	abstract public function dbSchemaVersion();
	abstract public function dbTablePrefix();
	abstract public function install();

	public function _install()
	{
		$this->installDB();
		$this->install();
	}

	public function installDB()
	{
		foreach ( $this->dbSchema as $t => $p )
		{
			$this->db()->createTable( $this->dbTablePrefix().'_'.$t, $p['fields'], $p['meta']  );
		}
	}
}
