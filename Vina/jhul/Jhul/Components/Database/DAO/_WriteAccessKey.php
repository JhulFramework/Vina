<?php namespace Jhul\Components\Database\DAO;

/* @Author : Manish DHruw [1D3N717Y12@gmail.com]
+-----------------------------------------------------------------------------------------------------------------------
| @Created : 2016-August
| IMPORTANT
| After Committing _modified_data it is imporant to update persistData, since entity maynot be reloaded, and may contain old values
+=====================================================================================================================*/
//after commit we should refresh  _data with newly acommitted data , since the class is not reloaded //IMPORTANT
//TODO CHeck if IsChanged() and isModified() working correctly

trait _WriteAccessKey
{
	public function isPersistent(){ return $this->_pData()->hasValue( $this->_p()->keyName() ); }

	public function commit( $force = FALSE )
	{
		$this->_mTable()->commit($this, $force) ;
	}

	public function delete(){ return $this->_mTable()->delete( $this ); }

	public function hasNew( $key )
	{
		if( $this->isModified()  )
		{
			if( $this->_mData()->has( $key ) ) return TRUE;
		}

		return parent::has($key);
	}

	//Value changed but no committed
	public function isModified()
	{
		if( isset( $this->_dataBags['modified'] ) )
		{
			return !$this->_mData()->isEmpty() ;
		}

		return FALSE;
	}

	//value changed and committed
	public function isChanged()
	{
		if( isset( $this->_dataBags['old'] ) )
		{
			return !$this->_oData()->isEmpty() ;
		}

		return FALSE;
	}

	//modified Data
	public function _mData(){ return $this->getDataBag('modified'); }

	//old Data
	public function _oData(){ return $this->getDataBag('old'); }

	private $_preparedNew = [];

	final public function readNewValue( $field, $silent = FALSE )
	{

		if( isset( $this->_preparedNew[$field] ) ) return $this->_preparedNew[$field];

		// pass to custom datareader
		if( isset( $this->readHandlers()[ $field ] ) )
		{
			$readHandler = $this->readHandlers()[ $field ];

			$this->_preparedNew[$field] = $this->$readHandler( $this->_readNewValue( $field, $silent ) );
		}

		$this->_preparedNew[$field] = $this->_mTable()->inflateValue( $this->_readNewValue($field), $field );

		return $this->_preparedNew[$field];
	}

	final public function _readNewValue( $field, $silent = FALSE )
	{

		if( $this->_mData()->has($field)  )
		{
			return $this->_mData()->read( $field , $silent );
		}

		if( !$silent )
		{
			throw new \Exception( 'ERROR_NO_READ_ACCES to field "'. get_called_class().'::'.$field.'" ' , 1);
		}

		return NULL;
	}

	public function _write( $key, $value )
	{
		$this->_mData()->write( $key, $value );

		//after write new value we need to reset prepared data from old values
		if( isset( $this->_preparedNew[$key] ) ) { unset( $this->_preparedNew[$key] ); }

		return $this;
	}

	final public function write( $key, $value )
	{

		if( isset( $this->writeHandlers()[$key] ) )
		{
			$writeHandler = $this->writeHandlers()[$key] ;

			return $this->_write( $key, $this->$writeHandler( $value, $key ) ) ;
		}

		return $this->_write( $key, $this->_mTable()->deflateValue( $value, $key ) );
	}

	public function writeHandlers(){ return []; }

	final public function writeAll( $data )
	{
		foreach ($data as $key => $value)
		{
			$this->write($key, $value);
		}

		return $this ;
	}

	public static function _create( $param )
	{
		return static::I()->_mTable()->create(new static(), $param) ;
	}

	public static function _createAndCommit( $param )
	{
		$i = static::_create($param);
		$i->commit();
		return $i ;
	}
}
