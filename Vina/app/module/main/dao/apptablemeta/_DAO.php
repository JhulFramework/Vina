<?php namespace _m\main\dao\apptablemeta;

abstract class _DAO extends \Jhul\Components\Database\DAO\_Class
{

	public function itemsCount()
	{
		return $this->read('itemsCount') ;
	}

	public function name()
	{
		return $this->read('tableName') ;
	}

	public static function findByTableName( $tableName )
	{
		return static::D()->where('tableName', $tableName)->fetch() ;
	}
}
