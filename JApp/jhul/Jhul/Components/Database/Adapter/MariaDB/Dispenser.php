<?php namespace Jhul\Components\Database\Adapter\MariaDB;


class Dispenser extends Statement\Types\Select
{

	use \Jhul\Core\_AccessKey;

	protected $_protoType;

	public function __call( $method, $params = [] )
	{
		$method = strtolower($method);

		if( 0 === strpos( $method, 'by' ) )
		{
			$field = substr( $method, 2 );

			if( !$this->protoType()->hasAccessToColumn( $field ) )
			{
				throw new \Exception( 'This entity "'.get_class($this->protoType()).'" cannot access field "'.$field.'" ' , 1);
			}

			array_unshift( $params, $field );

			return call_user_func_array( [$this, 'where' ], $params );

		}

		throw new \Exception( 'Call to undefined method  "'.static::class.': :'.$method.'()"',  1);
	}

	public function __construct( $_protoType )
	{
		$this->_protoType = $_protoType;

		$this
		->select( $this->_protoType->_p()->selectFields() )
		->setTable( $this->_protoType->_p()->tableName() );

		$where = $this->_protoType->_p()->whereConditions();

		if( is_array($where) && !empty($where) )
		{
			foreach ( $where as $key => $value)
			{
				$this->where($key, $value);
			}
		}
	}

	public function protoType()
	{
		return clone $this->_protoType;
	}

	public function database() { return $this->J()->cx('dbm')->getDB(); }


	public function findByKey( $key )
	{
		if( !empty($key) )
		{
			return $this->byKey( $key  )->fetch();
		}

		return $this->cookItem( NULL, 'find by empty key' );
	}

	public function cookItem( $record )
	{
		if( !empty($record) )
		{
			return $this->store()->_callAfter( 'populate',  $this->protoType()->_populate( $record ) );
		}


	}

	public  function byKey( $key ) { return $this->where( $this->protoType()->_p()->keyName(), $key ); }

	public function store(){ return $this->protoType()->_mTable(); }

	public function findByKeys( $keys )
	{
		if( !empty( $keys) )
		{
			return $this->whereIn( $this->protoType()->_p()->keyName(), $keys )->fetchAll();
		}

		return [];
	}
}
