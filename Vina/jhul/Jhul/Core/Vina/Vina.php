<?php namespace Jhul\Core\Vina;

class Vina
{

	use \Jhul\Core\_AccessKey;

	const STYLE_SELECTOR_MAP_NAME = '_style_selector_map';
	const CACHE_DIR_NAME = 'ui';

	private $_styleSelectorMap = [] ;

	private $_minify;

	private $_superLayout;
	private $_superLayoutClass;

	private $_scriptLibs = [];

	private $_mTime ;

	private $_mcx ;

	public function __construct()
	{
		$this->_styleSelectorMap = $this->sysFileStore()->readConfig( static::CACHE_DIR_NAME.'/'.static::STYLE_SELECTOR_MAP_NAME );
	}

	public function commitStyleSelectorMap()
	{
		$this->sysFileStore()->saveConfig( $this->_styleSelectorMap, static::CACHE_DIR_NAME.'/'.static::STYLE_SELECTOR_MAP_NAME );
	}

	public function renderView( $file, $params = [] )
	{
		ob_start();

		extract($params, EXTR_OVERWRITE);

		require($file);

		return ob_get_clean();
	}

	public function getStyleSelector( $viewKey )
	{
		$key = array_search( $viewKey, $this->_styleSelectorMap );

		if( !$key )
		{
			$key = $this->generateKey( $this->randomString()  );
			$this->_styleSelectorMap[$key] = $viewKey;
			$this->commitStyleSelectorMap();
		}

		return $key ;
	}

	private function generateKey( $key )
	{
		if( !isset($this->_styleSelectorMap[$key]) )
		{
			return $key ;
		}

		return $this->generateKey( $key.$this->randomString( strlen($key) ) ) ;
	}

	public function randomString( $length = 1, $charStrength = 0 )
	{

		$char = 'abcdefghijklmnopqrstuvwxyz';

		if( $charStrength > 1 )
			$char .= '0123456789';

		if( $charStrength > 2 )
			$char .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$char = str_shuffle($char);

		$charactersLength = strlen($char);

		$randomString = '';

		for ($i = 0; $i < $length; $i++)
		{
			$randomString .= $char[ rand( 0, $charactersLength - 1 ) ];
		}

		return $randomString;
	}




	public function mcx()
	{
		if( empty($this->_mcx) )
		{
			$this->_mcx = new Component\Manager;
		}

		return $this->_mcx ;
	}

	final public function createView( $name, $type )
	{
		return $this->mcx()->create( $name, $type ) ;
	}

	public function createUI( $cxName, $viewType )
	{
		return $this->createView( $cxName, $viewType );
	}

	public function scriptLibs()
	{
		if( empty($this->_scriptLibs) )
		{
			$this->_scriptLibs = $this->j()->fx()->readConfigFile( $this->app()->path().'/ui/libs/_scripts');
		}

		return $this->_scriptLibs ;
	}


	//@Param : $layoutFile = file name without extension
	public function compileContent( $layoutFile, $viewFragments )
	{
		$content = static::loadFileContents( $layoutFile );

		return static::injectParams( $content, $viewFragments );
	}

	public static function injectParams( $content, $fragments = [] )
	{
		if( !empty($fragments) )
		{
			foreach ( $fragments as $key => $value )
			{
				$fragments[ '|{{'.$key.'}}|' ] = $value;
				unset($fragments[$key]);
			}

			$content = preg_replace(array_keys($fragments), array_values($fragments), $content );
		}


		return $content;
	}

	public static function loadFileContents( $file, $extension = 'php' )
	{
		return file_get_contents( $file.'.'.$extension );
	}

	public function cacheContextStyle( $context, $name )
	{
		if( $context->webPage()->mStyle()->hasValue() )
		{
			$styleFileBaseName = $context->_dirNamespace().'/'.$name;

			$styleFile = $styleFileBaseName.'.css';

			if( !$this->j()->mPubFileStore()->ifFileExists($styleFile) || $context->controller()->ifRefreshWebPage() )
			{
				$this->j()->mPubFileStore()->saveFile
				(
					$context->webPage()->mStyle()->toString(),

					$styleFile
				);
			}
		}
	}

	public function minify()
	{
		if(empty($this->_minify))
		{
			$this->_minify = new Helper\Minify();
		}

		return $this->_minify ;
	}

	public function superLayout()
	{
		if(empty($this->_superLayout))
		{
			$class = $this->_superLayoutClass;
			$this->_superLayout = new $class('app');
		}

		return $this->_superLayout ;
	}

	public function setSuperLayout( $class )
	{
		$this->_superLayoutClass = $class;
		return $this ;
	}

	public function generateWebPage( $page, $relativeTemplateFilePath, $overwrite  )
	{
		$this->sysFileStore()->saveFile( $this->_makePage( $page, $overwrite ) , $relativeTemplateFilePath  );
	}

	public function sysFileStore()
	{
		return $this->j()->mSysFileStore() ;
	}

	private function _makePage(  Page\_Class $page, $ifRefresh  )
	{
		$page->build();
		$page->compile();

		if( !$page->ifUseSuperLayout() ) { return $page->compiledContent() ; }

		$this->superLayout()->setIfEnableIndexing( $page->ifEnableIndexing() === TRUE  );

		$this->loadPageStyleToSuperLayout( $page, $ifRefresh );
		$this->loadPageScriptToSuperLayout( $page, $ifRefresh );

		$this->superLayout()->setSuperContent( $page->compiledContent() );

		$this->superLayout()->compile();
		$this->superLayout()->cacheStyle($ifRefresh);
		$this->superLayout()->cacheScript($ifRefresh);

		//We need to recompile
		$this->superLayout()->compile();


		return $this->superLayout()->compiledContent();
	}


	public function loadPageScriptToSuperLayout( $page, $ifRefresh )
	{
		foreach ( $page->requiredScriptLibs() as $script )
		{
			if(!isset( $this->scriptLibs()[$script] ))
			{
				throw new \Exception( 'Script Libraray "'.$script.'" Not Found ' , 1);
			}

			$this->superLayout()->addScriptLink($script, $this->scriptLibs()[$script] );
		}

		if( $page->hasScript() )
		{
			$scriptFile = $page->_dirNamespace().'/script.js';

			if( !$this->j()->mPubFileStore()->ifFileExists( $scriptFile ) ||  $ifRefresh )
			{
				$this->j()->mPubFileStore()->saveFile
				(
					$page->script(),

					$scriptFile
				);
			}

			$this->superLayout()
			->addScriptLink( $page->name(), $this->j()->mPubFileStore()->url().'/'.$page->_dirNamespace().'/script' );
		}
	}

	private function loadPageStyleToSuperLayout( $page, $ifRefresh )
	{
		if( !$page->style()->isEmpty() )
		{
			$this->cacheStyle($page, $ifRefresh);

			$this->superLayout()
			->addStyleLink( $page->name(), $this->j()->mPubFileStore()->url().'/'.$page->_dirNamespace().'/style' );
		}
	}

	public function cacheStyle( $page, $ifRefresh = FALSE )
	{
		if( !$page->style()->isEmpty() )
		{
			$styleFile = $page->_dirNamespace().'/style.css';



			if( !$this->j()->mPubFileStore()->ifFileExists($styleFile) || $ifRefresh )
			{
				$this->j()->mPubFileStore()->saveFile
				(
					$this->minify()->minifyStyle( $page->compiledStyle() ),

					$styleFile
				);
			}
		}
	}




}
