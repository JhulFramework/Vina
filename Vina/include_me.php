<?php require_once( __DIR__.'/jhul/autoloader.php' );


defined('JHUL_IF_ENABLE_DEBUG') or define( 'JHUL_IF_ENABLE_DEBUG', TRUE );

function createJApp( $publicRoot = '' )
{

	$config =
	[
		'public_root' => $publicRoot,

		//if not defined, it will auto resolve
		'base_url' => '',

		'data_store_directory_path' => __DIR__.'/_data',

		//relative to public_root
		'public_cache_directory' => 'jcache',
	];

	\Jhul::create( $config );


	\Jhul::I()->cx()

	//providing patH to look for component configuration //PRIMARY
	->setServerConfigPath( __DIR__.'/server' )

	//providing path to look for component configuration //SECONDARY
	->setAppConfigPath( __DIR__.'/app/_config' )

	->setAssemblyPath( __DIR__.'/assembly' );


	\Jhul::I()->fx()

	->add( 'app', __DIR__.'/app' )

	//setting namespace for modules
	->add( '_m', __DIR__.'/app/module' ) ;

	//\Jhul::I()->ui()->setSuperLayout('app\\ui\\superlayout\\main\\Layout');
}
