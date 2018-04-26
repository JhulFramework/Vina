<?php namespace Jhul\Components\Database\DAO;

/* @Author : Manish Dhruw [ 1D3N717Y12@gmail.com ]
+=====================================================================================================================
| @Created : Saturday 15 February 2014 10:35:28 AM IST
| @Updated : [ 2015Jan03, 2015April09, 2016July07, 2016-August[06,13], 2016Sep04 , 2017Jun25, 2018Jan14 ]
+---------------------------------------------------------------------------------------------------------------------*/

abstract class _Class
{

	use \Jhul\Core\_AccessKey;

	protected $_dataBags = [];

	protected $_inflated = [];

	private $_prepared = [];

	private $_paramBagClass;

	public function paramBagClass()
	{
		if( empty($this->_paramBagClass) )
		{
			$this->_paramBagClass = $this->j()->fx()->rChop(get_called_class()).'\\_P';

			if( !class_exists($this->_paramBagClass) )
			{
				throw new \Exception( 'Parameter Bag Class Not Found For "'.get_called_class().'"',  1);
			}
		}

		return $this->_paramBagClass ;
	}

	final public function invalidatePreparedValues()
	{
		$this->_prepared = [];
		return $this ;
	}

	final public function _s( $key, $value )
	{
		$key = '_'.$key;

		$this->$key = $value;

		return $this ;
	}

	final public function _p()
	{
		if( !$this->j()->cx('dbm')->hasParamBag($this->paramBagClass()) )
		{
			$this->j()->cx('dbm')->createParamBag($this->paramBagClass(), static::I() );
		}

		return $this->j()->cx('dbm')->getParamBag( $this->paramBagClass() ) ;
	}

	public function getDB() { return $this->J()->cx('dbm')->getDB(); }

	public function getDataBag( $name )
	{
		if( !isset( $this->_dataBags[ $name ]  ) )
		{
			$this->_dataBags[$name] = new DataBag( $this );
		}

		return $this->_dataBags[$name];
	}

	public function has( $field ){ return $this->_pData()->has($field); }

	public function hasWriteAccess() { return FALSE; }

	public function ifEmpty( $field, $silent = TRUE )
	{
		return empty( $this->read($field, $silent) );
	}

	//if its nul Data model
	public function isNull(){ return FALSE ;}

	public function key()
	{
		return $this->_pData()->read( $this->_p()->keyName() );
	}

	//Persitent Data (committed to the database)
	public function _pData(){ return $this->getDataBag('persistent'); }

	// @Param $data : from database
	// @Param $sql : used sql to load this data from database
	public function _populate( array $data )
	{
		$this->_pData()->_set( $data );
		return $this;
	}

	final public function read( $field, $silent = FALSE )
	{

		if( isset( $this->_prepared[$field] ) ) return $this->_prepared[$field];


		// pass to custom datareader
		if( isset( $this->readHandlers()[ $field ] ) )
		{
			$readHandler = $this->readHandlers()[ $field ];

			$this->_prepared[$field] = $this->$readHandler( $this->_read( $field, $silent ) );
		}

		$this->_prepared[$field] = $this->_mTable()->inflateValue( $this->_read($field), $field );

		return $this->_prepared[$field];
	}

	//returns encoded value
	final public function _read( $field, $silent = FALSE )
	{
		if( $this->hasAccessToColumn( $field )  )
		{
			return $this->_pData()->read( $field );
		}

		if( !$silent )
		{
			throw new \Exception( 'ERROR_NO_READ_ACCES to field "'. get_called_class().'::'.$field.'" ' , 1);
		}

		return NULL;
	}

	protected function readHandlers(){ return []; }


	final public function _hasReadAccessTo( $key )
	{
		return $this->_p()->hasAccessToColumn($key) ;
	}


	public function hasAccessToColumn($key)
	{
		return $this->_p()->hasAccessToColumn($key) ;
	}

	public function write( $key, $value )
	{
		$this->_write( $key, $value );
	}

	public function _write( $key, $value )
	{
		throw new \Exception( 'This DB Enitity "'.get_called_class().'" has no write access' , 1);
	}

	public static function I() { return new static(); }

	//dispenser
	public static function D()
	{
		return static::I()->_p()->dispenser() ;
		//$prototype = static::I();
		//return $prototype->getDB()->dispenser( $prototype );
	}

	// public static function _tableItemsCounter()
	// {
	// 	$prototype = static::I();
	// 	return $prototype->getDB()->counter( $prototype );
	// }
	//
	// public static function _tableLastItemKey()
	// {
	// 	return static::I()->P()->lastItemKey();
	// }

	final public function _mTable()
	{
		return $this->_p()->mTable() ;
	}

}
