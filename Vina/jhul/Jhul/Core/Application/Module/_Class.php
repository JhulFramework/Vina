<?php namespace Jhul\Core\Application\Module ;

/* @Author Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Responsibilities
| -loads configuration from module
|
| @Created
| -Friday 19 December 2014 08:23:15 PM IST
|
| @Updated
| -Saturday 23 May 2015 06:21:56 PM IST
| -Sun 15 Nov 2015 07:25:41 PM IST
| -[2016-Oct-01, 2017-Aug-30, 2017-DEC-01]
+---------------------------------------------------------------------------------------------------------------------*/

abstract class _Class extends \Jhul\Core\Application\Domain\_Class
{

	use \Jhul\Core\Application\Domain\_HasSubDomains;

	//protected $_namespaceToContextKeyMap = [] ;

//	public $elementMap = [];

	public function _subDomainKeySuffix() { return $this->app()->mapper()->addonIdentifier() ; }

	public function _resolveSubDomainClass( $name )
	{
		return $this->_namespace().'\\addon\\'.$name.'\\Addon' ;
	}

	public function _resolveSubDomainPath( $name )
	{
		return $this->path().'/addon/'.$name ;
	}

	public function addon( $key )
	{
		return $this->_subDomain($key) ;
	}

	public function mDomain( )
	{
		return $this->app()->mDomain() ;
	}


	public function getContextByNamespace( $forClass )
	{
		return $this->mContext()->getByNamespace( $forClass ) ;
	}


	// public function dataStoreDirectoryPath()
	// {
	// 	return $this->app()->dataStoreDirectoryPath().'/'.$this->dirNamespace();
	// }
	//
	// public function pubCachePath()
	// {
	// 	return $this->app()->mPubCache()->path().'/'.$this->dirNamespace();
	// }

	//e.g (webitse.com/) res/_m/module_key
	// public function pubResUrl()
	// {
	// 	return $this->app()->pubResUrl().'/'.$this->dirNamespace();
	// }
	// public function pubCacheUrl()
	// {
	// 	return $this->app()->pubCacheUrl().'/'.$this->dirNamespace();
	// }

	public static function getClass() { return static::class; }


	public function makePage( $name )
	{
		if( !strrpos($name, '\\' ) && !strpos($name, $this->app()->mapper()->pageIdentifier() ) )
		{
			$name = $this->key().$this->getApp()->mapper()->pageIdentifier().$name;
		}

		$this->getApp()->makePage($name) ;
	}

	public function cook( $name, $params = [] )
	{
		if( 'webpage' == $this->getApp()->outputMode() && !strpos($name, $this->getApp()->mapper()->viewIdentifier() )  )
		{
			$name = $this->key().$this->getApp()->mapper()->viewIdentifier().$name;
		}

		$this->getApp()->response()->page()->cook( $name, $params );
	}

	public function loadResource( $fileName )
	{
		$data = require( $this->path().'/res/'.$fileName.'.php' );

		return is_array( $data ) ? $data : [] ;
	}

	public function registerView( $view_name, $view_file )
	{
		$this->getApp()->mapper()->registerView( $this->key(), $view_name, $view_file );
	}

}
