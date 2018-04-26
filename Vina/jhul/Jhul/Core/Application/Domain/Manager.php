<?php namespace Jhul\Core\Application\Domain;

/* @Author Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Created : 12018OCT15
+---------------------------------------------------------------------------------------------------------------------*/

class Manager
{
	use \Jhul\Core\_AccessKey ;

	const REGISTER_DATA_KEY = '_domainCache';
	const CONTEXT_MAP_KEY = 'contexts';
	const MUX_MAP_KEY = 'muxes';

	private $_cache = [];

	public function __construct()
	{
		$this->_cache = $this->j()->register()->get( static::REGISTER_DATA_KEY, FALSE );

		if(empty($this->_cache))
		{
			$this->_cache =
			[
				'installed' => [],
				static::CONTEXT_MAP_KEY => [],
				static::MUX_MAP_KEY => []
			];
		}

		$this->loadCache();
	}

	private function loadCache()
	{
		$this->app()->mapper()->setContextMap( $this->_cache[ static::CONTEXT_MAP_KEY ] );
		$this->app()->mapper()->setMUXMap( $this->_cache[ static::MUX_MAP_KEY] );

	}

	public function loadDomain( $name,  $parent )
	{

		$class = $parent->_resolveSubDomainClass($name);

		$domain = new $class;

		$domain
		->_s('name', $name)
		->_s('namespace', $this->j()->fx()->rchop( $class ))
		->_s('path', $parent->_resolveSubDomainPath($name))
		->_s('domainKeySuffix', $parent->_subDomainKeySuffix() )
		->_s('dirNamespace', $parent->_dirNamespace().'/_d_'.$domain->_name() )
		->_s('parentDomainKey', $parent->_key() )
		->_s('config', new \Jhul\Core\Containers\Config)
		->_s('mContext', new Context\Manager( $domain->_key() ) )
		;

		$domain->config()->add( $this->loadConfigFile( $domain->path().'/_config/_main', FALSE ) );

		$map = $this->loadConfigFile( $domain->path().'/_config/_datatypes', FALSE ) ;


		$this->app()->mDataType()->register
		(

			$this->loadConfigFile( $domain->path().'/_config/_datatypes', FALSE )
		);

		if( !$this->ifDomainInstalled($domain->_key()) )
		{
			$this->install($domain);
		}

		return $domain ;
	}

	public function ifDomainInstalled( $domainKey )
	{
		return isset($this->_cache['installed'][$domainKey]) ;
	}

	public function install( $domain )
	{

		$this->registerEvents( $domain );


		$installer_file = $domain->path().'/setup/Setup.php';

		if( file_exists($installer_file  ) )
		{

			$class = $domain->_namespace().'\\setup\\Setup';

			$class::I( $domain )->_install();
		}

		$this->_loadDomainRoutes( $domain );


		$this->_cache['installed'][$domain->_key()] = $domain->_key();

		$this->_commitRegister();
	}

	public function registerEvents( $module )
	{
		$events = $this->loadConfigFile(  $module->path().'/_config/_event_listeners', FALSE );
		if(!empty($events))
		{
			$this->j()->cx('event')->registerListener($events);
		}
	}

	private function _loadDomainRoutes( $domain )
	{
		$this->app()->mapper()->registerMUXMap
		(
			$domain->_key(), $this->loadConfigFile( $domain->path().'/_config/_muxes', FALSE )
		);

		$this->app()->mapper()->registerContextMap
		(
			$domain->_key(), $this->loadConfigFile( $domain->path().'/_config/_contexts', FALSE )
		);

		$this->_cache[ static::CONTEXT_MAP_KEY ] = $this->app()->mapper()->contextMap();
		$this->_cache[ static::MUX_MAP_KEY ] = $this->app()->mapper()->muxMap();
	}

	private function _commitRegister()
	{
		$this->j()->register()->set( static::REGISTER_DATA_KEY , $this->_cache );

		$this->j()->register()->commit();
	}

	private function loadConfigFile( $file, $required )
	{
		return $this->J()->fx()->loadConfigFile( $file, $required );
	}

}
