<?php namespace Jhul\Core\Application\Module;

/* @Author : Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Updated : [ 2016-august-01, 2016-Oct-01, 2016-Oct-16, 2017-02-12,2017nov21 ]
+---------------------------------------------------------------------------------------------------------------------*/

class Manager
{

	use \Jhul\Core\_AccessKey;

	const REGISTER_DATA_KEY = 'installed_modules';

	private $_installed_modules = [];

	//TODO Cache it, and check performance
	protected $_loaded_module = [];

	public function __construct()
	{
		$this->_installed_modules = $this->j()->register()->get( static::REGISTER_DATA_KEY, FALSE );
	}

	public function fx()
	{
		return $this->j()->fx() ;
	}

	public function mapper()
	{
		return $this->app()->mapper();
	}

	//@Params : $name = name of module
	public function g( $name )
	{
		if( !isset( $this->_loaded_module[$name] ) )
		{

			$this->load( $name );
		}

		return $this->_loaded_module[ $name ];
	}

	protected function load( $name )
	{
		$modulePath = $this->app()->path().'/module/'.$name;

		$module_class = '_m\\'.$name.'\\Module';

		if( !class_exists($module_class) )
		{
			throw new \Exception( 'Module class "'.$module_class.'" Not Found' , 1);
		}

		//$module = new $module_class( $name, $modulePath );
		$module = $this->app()->configLoader()->assembleDomain($name, $modulePath, $module_class);

		$module->_s( 'dirNamespace',	'app/_m/'.$module->key() );

		//$module->_s( 'mContext', new Context\Manager( $this->loadContexts( $modulePath ), $module->key() ) );


		$this->_loaded_module[ $name ] = $module;

		$this->app()->configLoader()->load( $this->_loaded_module[ $name ] ) ;

		if(  !isset( $this->_installed_modules[$module->key()]) )
		{
			$this->install( $module );
		}
	}

	public function loadContexts( $path )
	{
		$contexts = $this->fx()->loadConfigFile(  $path.'/_config/_contexts', FALSE );

		array_multisort(array_map('strlen', $contexts), $contexts);

		return array_reverse($contexts);
	}

	public function install( $module )
	{
		ob_clean();
		echo '<pre>';
		echo '<br/> File : <br/>'.__FILE__.':'.__LINE__.'</br></br>';
		var_dump('break');
		echo '</pre>';
		exit();
		$installer_file = $module->path().'/setup/Setup.php';

		if( file_exists($installer_file  ) )
		{
			$class = $this->fx()->rChop( get_class($module) ).'\\setup\\Setup';

			$class::I( $module )->_install();
		}

		$this->installAddons($module);
		$this->registerEvents($module);

		$this->_installed_modules[$module->key()] = $module->key();

		$this->j()->register()->set( static::REGISTER_DATA_KEY, $this->_installed_modules );
		$this->j()->register()->commit();

		//$this->app()->mSysCache()->writeConfig( static::MODULE_REGISTER_NAME, $this->_installed_modules );
	}

	public function registerEvents( $module )
	{
		$events = $this->fx()->loadConfigFile(  $module->path().'/_config/_event_listeners', FALSE );
		if(!empty($events))
		{
			$this->j()->cx('event')->regisiterListener($events);
		}
		ob_clean();
		echo '<pre>';
		echo '<br/> File : <br/>'.__FILE__.':'.__LINE__.'</br></br>';
		var_dump('break');
		echo '</pre>';
		exit();
	}

	public function installAddons( $module )
	{
		foreach ($module->addOnMap() as $key => $class)
		{
			$setupFile = $module->path().'/addon/'.$key.'/setup/Setup.php';

			if( file_exists($setupFile) )
			{
				$class = $this->fx()->rChop( $class ).'\\setup\\Setup';

				$class::I( $module )->_install();
			}
		}
	}

	public function __toString()
	{
		return json_encode( $this->_module_map );
	}
}
