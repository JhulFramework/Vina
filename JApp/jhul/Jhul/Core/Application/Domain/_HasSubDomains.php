<?php namespace Jhul\Core\Application\Domain;

/* @Author Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Created : 12018JAN15
+---------------------------------------------------------------------------------------------------------------------*/

trait _HasSubDomains
{

	private $_installedDomains = [];

	//loaded
	protected $_subDomains = [];

	abstract public function _subDomainKeySuffix();
	abstract public function _dirNamespace();
	abstract public function _resolveSubDomainClass( $name );
	abstract public function _resolveSubDomainPath( $name );
	abstract public function _key();

	public function _hasSubDomain()
	{
		return TRUE; ;
	}

	public function _ifSDLoaded( $key )
	{
		return isset( $this->_subDomains[$key] ) ;
	}

	final public function _subDomain( $key )
	{
		if( isset($this->_subDomains[$key]) )
		{
			return $this->_subDomains[$key] ;
		}

		$this->_subDomains[$key] = $this->mDomain()->loadDomain( $key, $this );

		$this->_subDomains[$key]->afterAssembled();

		return $this->_subDomains[$key] ;
	}

	public function context( $key  )
	{
		if( strpos( $key, $this->_subDomainKeySuffix() ) )
		{
			$l = explode( $this->_subDomainKeySuffix(), $key );

			return $this->_subDomain($l[0])->context($l[1]);
		}

		return parent::context($key) ;
	}

	abstract function mDomain();
}
