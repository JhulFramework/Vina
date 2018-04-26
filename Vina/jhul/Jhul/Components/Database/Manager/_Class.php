<?php namespace Jhul\Components\Database\Manager;

/* @Author : Manish Dhruw [ 1D3N717Y12@gmail.com ]
+=======================================================================================================================
|
+---------------------------------------------------------------------------------------------------------------------*/

abstract class _Class
{
	use \Jhul\Core\_AccessKey;

	protected $_fields = [];

	// Data Access Object Class map
	protected $_dao_map =
	[
		'null' => __NAMESPACE__.'\\Data\\_NULL',
	];

	// save record to database
	// @return modified datamodel
	// @param $DAO can be data entity
	private function insert( $DAO )
	{
		$DAO = $this->_callBefore( 'insert', $DAO );

		$this->getDB()->insert( $DAO );

		$key = $this->getDB()->pdo()->lastInsertId();

		//setting persistent data as old data
		$DAO->_oData()->_set( $DAO->_pData()->_get() );

		//setting modified data as persistent data
		$DAO->_pData()->_set( $DAO->_mData()->_get() );

		if( $DAO->_mData()->has( $DAO->_p()->keyName() ) )
		{
			$key = $DAO->_mData()->read( $DAO->_p()->keyName() );
		}

		$DAO->_pData()->_set( $DAO->_p()->keyName(), $key );


		$DAO = $this->_callAfter( 'insert', $DAO );

		$this->j()->cx('event')->trigger('sys_db#onItemCreated', $DAO);

		return $DAO ;
	}

	public function _callBefore( $method, $DAO )
	{
		$method = 'before'.$method;

		return method_exists( $this, $method ) ? $this->$method( $DAO ) : $DAO ;
	}

	public function _callAfter( $method, $DAO )
	{
		$method = 'after'.$method;

		return method_exists( $this, $method ) ? $this->$method( $DAO ) : $DAO ;
	}

	public function commit( $DAO, $forced = FALSE )
	{
		if( !$DAO->isModified() && !$forced ) return;

		$DAO = $this->_callBefore( 'commit', $DAO );

		$DAO = $DAO->isPersistent() ? $this->update($DAO) : $this->insert( $DAO ) ;

		return $this->_callAfter( 'commit', $DAO );
	}



	public function defaultValues(){ return []; }

	//compress or preprocess data befor storing in database
	public function deflateValue( $value, $field )
	{
		if( isset($this->valueDeflaters()[ $field ] )  )
		{
			$deflater = $this->valueDeflaters()[ $field ];

			return $this->$deflater( $value, $field );
		}

		return $value;
	}

	public function delete( $DAO  )
	{
		$this->_callBefore( 'delete', $DAO );

		$DAO->getDB()->_delete( $DAO );

		$this->_callAfter( 'delete', $DAO );

		$this->j()->cx('event')->trigger('sys_db#onItemDeleted', $DAO);

	}

	public function getDB(){ return \Jhul::I()->cx('dbm')->getDB(); }

	public function htmlEncode( $string, $maxLength = 0 )
	{
		return $this->j()->cx('html')->encode( $string, $maxLength ) ;
	}

	public static function I()
	{
		return \Jhul::I()->cx('dbm')->getStore( get_called_class() );
	}

	//expands data to readable
	public function inflateValue( $value, $field )
	{
		if( isset($this->valueInflaters()[$field] )  )
		{
			$inflater = $this->valueInflaters()[$field];

			return $this->$inflater( $value, $field );
		}

		return $value;
	}

	// - initilize fields of newly created Item
	// - Check if all fields are initilized
	public function initilizeFields( $DAO, $params )
	{
		foreach ( $this->defaultValues() as $key => $value)
		{
			$DAO->write( $key, $value );
		}

		foreach ( $params  as $key => $value)
		{
			$DAO->write($key, $value);
		}

		return $DAO;
	}

	//Updates Already existing record
	private function update( $DAO )
	{
		$DAO = $this->_callBefore( 'update', $DAO );

		$this->getDB()->update( $DAO );

		$DAO->_oData()->_set( $DAO->_pData()->_get() );

		$DAO->_pData()->_set( $DAO->_mData()->_get() );

		$DAO->invalidatePreparedValues();

		return $this->_callAfter( 'update', $DAO );
	}

	public function useNULLDataModel(){ return FALSE; }

	public function valueDeflaters(){ return []; }

	public function valueInflaters(){ return []; }


	//only create and return datamodel using data array, but does not saves it to database
	public function create( $dao, $params = []  )
	{
		foreach ($params as $key => $value)
		{
			$dao->write( $key, $value );
		}

		return $this->initilizeFields( $dao, $params );
	}

	//create data model from data array, saves it database and return datamodel
	public function createAndCommit( $dao, $params = [] )
	{
		return $this->commit( $this->create( $dao, $params ) );
	}
}
