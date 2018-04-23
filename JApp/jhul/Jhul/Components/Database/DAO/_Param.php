<?php namespace Jhul\Components\Database\DAO;

abstract class _Param
{

	use \Jhul\Core\_AccessKey;

	const TABLE_MANAGER_CLASS =  'Jhul\\Components\\Database\\Manager\\Manager' ;

	protected $_executedQuery;

	private $_prototype;

	abstract function keyName();

	abstract function selectFields();

	abstract function tableName();

	public function executedQuery(){ return $this->_executedQuery; }

	public function setExecutedQuery( $query )
	{
		$this->_executedQuery = $query ;
		return $this ;
	}

	public function __construct( $prototype )
	{
		$this->_prototype = $prototype;
		$class = $this->tableManagerClass();
		$this->_tableManager = new $class;
	}

	public function hasAccessToColumn($key)
	{
		return  ( '*' == $this->selectFields() ) ||  in_array( $key, $this->selectFields() );
	}

	public function mTable()
	{
		return $this->_tableManager ;
	}

	abstract public function tableManagerClass();


	final public function itemCounter()
	{
		return $this->_prototype->getDB()->counter( $this->_prototype );
	}

	final public function lastItemKey()
	{
		$lastItem = $this->dispenser()->orderBy( $this->keyName(), 'DESC' )->fetch();

		if( !empty($lastItem) )
		{
			return $lastItem->key() ;
		}

		return 0 ;
	}

	public function dispenser()
	{
		return $this->_prototype->getDB()->dispenser($this->_prototype);
	}

	private $_tableMeta;

	public function tableMeta()
	{
		if( empty($this->_tableMeta) )
		{
			$class = $this->tableMetaClass();
			$this->_tableMeta = $class::findByTableName( $this->tableName() );
		}

		return $this->_tableMeta ;
	}

	public function tableMetaClass()
	{
		$metaClass = $this->j()->fx()->rchop( get_class($this->_prototype) ).'\\meta\\DAO';

		if( class_exists($metaClass) )
		{
			return $metaClass ;
		}

		throw new \Exception( 'Meta DAO class not found for DAO "'.get_class($this->_prototype).'" ' , 1);

	}

	/*
	| MUST return and array Select where condition
	*/
	abstract public function whereConditions();

}
