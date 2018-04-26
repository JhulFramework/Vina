<?php namespace _m\main\dao\apptablemeta;

abstract class _P extends \Jhul\Components\Database\DAO\_Param
{
	public function keyName()
	{
		return 'identityKey' ;
	}

	public function tableName()
	{
		return 'jSys_appTableMeta' ;
	}

	public function tableManagerClass()
	{
		return static::TABLE_MANAGER_CLASS ;
	}
}
