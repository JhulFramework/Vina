<?php namespace Jhul\Core\Application;

class Application
{
	use \Jhul\Core\Design\Component\_Trait;
	use Domain\_HasSubDomains;

	protected $_configLoader;

	// @DataType: Object:
	protected $_client_request;

	protected $_mDataType;

	protected $_user;

	protected $_response;

	//application script path
	protected $_path;

	protected $_mActivity;

	//Handler Maanger
	protected $_mMUX;

	//URL manager
	protected $_mURL;

	//Page Manager
	protected $_mPage;

	protected $_data;

	//protected $_modules = [];

	protected $_session;

	private $_mDomain;

	//this method will be called before running application
	protected function beforeRun(){}

	public function __construct( $params  )
	{
		$this->_path = $this->J()->fx()->dirPath( get_called_class() );



		$this->_mMUX	= new MUX\Manager;

		$this->_configLoader	= new ConfigLoader;

		$this->_mDataType = new DataType\Manager;

		//TODO remove it
		$this->_data = new SharedData;

		$this->_mapper = new Mapper;

		//$this->_mURL = new URLManager( $params['url'], $this->J()->fx()->loadConfigFile( $params['url_map'] ) );
	}


	final public function _key() { return '' ; }
	final public function _dirNamespace() { return 'app' ; }

	public function _subDomainKeySuffix(){ return $this->mapper()->moduleIdentifier() ; }
	public function _resolveSubDomainClass( $name )
	{
		return '_m\\'.$name.'\\Module' ;
	}

	public function _resolveSubDomainPath( $name )
	{
		return $this->path().'/module/'.$name ;
	}


	public function configLoader(){ return $this->_configLoader; }

	public function clientRequestRoute()
	{
		if( empty($this->_client_request) )
		{

			$this->_client_request = $this->user()->request()->route() ;
		}

		return $this->_client_request;
	}

	protected $_output_mode;

	public function outputMode()
	{
		if( empty($this->_output_mode) )
		{
			$this->_output_mode = $this->resolveOutputMode();

			if( empty($this->_output_mode) )
			{
				$this->_output_mode = 'webpage';
			}
		}

		return $this->_output_mode;
	}

	protected function resolveOutputMode(){}

	public function lipi(){ return $this->J()->cx('lipi'); }

	public function language(){ return $this->J()->cx('lipi')->currentLanguage(); }



	public function mData( ){ return $this->_data; }
	public function name()	{ return $this->config('name') ; }
	public function user()	{ return $this->_user; }

	public function mapper()
	{
		return $this->_mapper;
	}

	public function response()
	{
		if( empty($this->_response) )
		{
			$this->_response = new Response\Response( $this->user()->request()->mode() );
		}

		return $this->_response;
	}


	public function mDomain()
	{
		return $this->_mDomain;
	}


//	public function mPage(){ return $this->_mPage; }

	public function mMUX(){ return $this->_mMUX; }

	public function mURL(){ return $this->_mURL; }

	public function path(){ return $this->_path; }

	public function session(){ return $this->_session; }

	public function router(){ return $this->J()->cx('router'); }


	public function m( $name )
	{

		return $this->_subDomain($name) ;

		if( !empty( $name ) )
		{
			return $this->_moduleStore->g( $name );
		}

		return $this->_moduleStore;
	}


	public function mDataType( $type = NULL )
	{
		if( !empty($type))
		{
			return $this->_mDataType->get($type);
		}
		return $this->_mDataType;
	}

	public function mDT( $type = NULL )
	{
		if( !empty($type))
		{
			return $this->_mDataType->get($type);
		}
		return $this->_mDataType;
	}

	public function getFlash( $key = 'flash' )
	{
		return $this->session()->pull( $key );
	}

	public function handleNode( $node )
	{
		return $this->mMUX()->run( $node, TRUE );
	}

	public function hasFlash( $key = 'flash' )
	{
		return $this->session()->has($key);
	}

	public function pubResPath()
	{
		return $this->j()->publicRoot().'/'.$this->config('public_resource_directory');
	}

	public function pubResUrl()
	{
		return $this->url().'/'.$this->config('public_resource_directory');
	}

	protected function resolveClientRequest()
	{

		if( $this->clientRequestRoute()->type() == 'mux' )
		{
			return $this->runHandler( $this->clientRequestRoute()->resource(), $this->clientRequestRoute()->params() );
		}

		if( $this->clientRequestRoute()->type() == 'context' )
		{
			return $this->context( $this->clientRequestRoute()->context() )->handle( $this->clientRequestRoute()->params() );
		}

		// if( $this->clientRequestRoute()->type() == 'virtual_node' )
		// {
		// 	return $this->renderVirtualNode( $this->clientRequestRoute()->resource(), $this->clientRequestRoute()->params() );
		// }
	}

	public function redirect( $url )
	{
		header( 'Location: '.$url );
		exit;
	}

	private function registerExceptionHandler()
	{
		// $this->j()->ex()->createCallbackHandler
		// (
		// 	function()
		// 	{
		// 		$this->handleNode('SERVER_ERROR');
		// 		$this->sendResponse();
		// 		return FALSE;
		// 	}
		// );
	}


	public function renderVirtualNode( $route, $params =[] )
	{
		if( is_string($route) )
		{
			$route = $this->M()->mapper()->identifyResource($route);
		}

		$this->renderFile( $this->m( $route->moduleKey() )->path().'/virtual_node/'.$route->target().'.php' , $params );
	}

	public function renderFile( $file, $params =[] )
	{
		if( !$this->J()->ifDebugOn() )
		{
			$this->registerExceptionHandler();
		}

		$this->beforeRun();


		$this->response()->page()->loadFile( $file , $params );
	}

	public function initializeWebpage(){}

	public function run()
	{
		if( !$this->J()->ifDebugOn() )
		{
			$this->registerExceptionHandler();
		}

		$this->beforeRun();

		if( $this->outputMode() == 'webpage' )
		{
			$this->initializeWebpage();
		}

		$this->resolveClientRequest();

		$this->response()->setStatusCode( $this->user()->request()->route()->statusCode() );


		if( $this->response()->isEmpty() )
		{
			$this->m('main')->context('error404')->handle();
		}

		return $this->response()->send();
	}

	public function getContext( $context )
	{
		$slug = explode('@', $context);

		return $this->m($slug[0])->getContext( $slug[1] ) ;
	}

	//@param : $context = module@context
	public function makePage( $context, $params = [] )
	{
		$this->getContext($context)->run( $params );
	}

	//@param : $handler = can be NAME CLASS or PAGE NAME( [module][pageIdentifier][page] )
	public function runHandler( $handler, $params = [] )
	{
		return $this->mMUX()->run( $handler , $params );
	}

	public function s( $name, $com )
	{
		$name = '_'.$name;

		$this->$name = $com;
	}

	public function sysCachePath()
	{
		return JHUL_SERVER_CACHE_DIRECTORY;
	}

	public function setFlash( $value, $key = 'flash' )
	{
		$this->session()->set( $key, $value );
	}

	public function url( $append = NULL )
	{
		if( !empty($append) )
		{
			return $this->j()->baseURL().'/'.$append;
		}

		return $this->j()->baseURL();
	}
}
