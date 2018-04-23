<?php namespace Jhul\Core\Application\Domain;

/* @Author Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Created : 12018JAN15
+---------------------------------------------------------------------------------------------------------------------*/

abstract class _Class
{
	use \Jhul\Core\_AccessKey;

	private $_name;
	private $_path;

	private $_parentDomainKey;
	private $_domainKey;
	private $_domainKeySuffix;

	private $_dirNamespace;

	private $_config;
	private $_mContext;

	final public function config( $key = NULL, $required = TRUE )
	{
		if( !empty( $key ) ) return $this->_config->get($key, $required);

		return $this->_config;
	}

	public function mContext(){ return  $this->_mContext; }


	public function context($key)
	{
		return $this->mContext()->get($key) ;
	}

	public function path(){ return $this->_path; }

	public function _s( $prop, $value )
	{
		$prop = '_'.$prop;

		$this->$prop = $value;

		return $this;
	}

	abstract function afterAssembled();

	final public function _name()
	{
		return $this->_name ;
	}

	//domain name space
	final public function _key()
	{
		return $this->_parentDomainKey.$this->_name().$this->_domainKeySuffix;
	}

	public function _hasSubDomains(){ return FALSE ; }

	final public function _namespace()
	{
		return $this->_namespace ;
	}

	final public function _dirNamespace()
	{
		return $this->_dirNamespace ;
	}
}
