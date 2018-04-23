<?php namespace _m\main\context\sys\dao;

class TableMeta extends \_m\main\dao\tablemeta\_DAO
{
	use \Jhul\Components\Database\DAO\_WriteAccessKey;

	public static function create( $tableName, $count )
	{

		$item = (new static())
		->write( 'table_name', $tableName )
		->write( 'row_count', $count )
		->commit();

		return $item;
	}

	public function context()
	{
		return 'sys' ;
	}
}
