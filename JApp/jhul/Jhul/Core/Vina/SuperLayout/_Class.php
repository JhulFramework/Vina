<?php namespace Jhul\Core\UI\SuperLayout;

abstract class _Class extends \Jhul\Core\UI\View\Layout
{


	private $_dirNamespace ;
	private $_mHead ;
	private $_mMeta ;
	private $_mStyle ;
	private $_mScript ;

	private $_p;

	final public function mMeta()
	{
		if( empty($this->_mMeta) )
		{
			$this->_mMeta = new Meta();
		}

		return $this->_mMeta ;
	}

	public function _p( $key = NULL )
	{
		if(empty($this->_p))
		{
			$this->_p = new _P( $this->j()->fx()->readConfigFile( $this->j()->fx()->dirPath(get_called_class()).'/_config' ) );
		}

		if( NULL !== $key ) return $this->_p[$key] ;

		return $this->_p ;
	}

	final public function mStyle()
	{
		if( empty($this->_mStyle) )
		{
			$this->_mStyle = new Style();
		}

		return $this->_mStyle ;
	}

	final public function mScript()
	{
		if( empty($this->_mScript) )
		{
			$this->_mScript = new Script();
		}

		return $this->_mScript ;
	}

	public function beforeCompile()
	{
		$this->setFragment('super_head', $this->compileHead() );
		$this->setFragment('super_script', $this->mScript()->compile() );
		parent::beforeCompile();
	}

	final public function _dirNamespace()
	{
		if( empty($this->_dirNamespace) )
		{
			$this->_dirNamespace = str_replace( '\\', '/', $this->j()->fx()->rChop(get_called_class()) );
		}

		return $this->_dirNamespace ;
	}

	public function compileHead()
	{
		return $this->mMeta()->compile().' '.$this->mStyle()->compile() ;
	}

	public function setIfEnableIndexing( $bool )
	{
		$this->mMeta()->setIfEnableIndexing( $bool );
		return $this ;
	}

	public function setSuperContent( $content )
	{
		$this->setFragment( 'super_content', $content );

		return $this ;
	}

	public function cacheStyle( $ifRefresh = FALSE )
	{
		if( !$this->style()->isEmpty() )
		{

			$this->j()->ui()->cacheStyle( $this, $ifRefresh );

			$this->addStyleLink( $this->name(), $this->j()->mPubFileStore()->url().'/'.$this->_dirNamespace().'/style' );
		}
	}

	public function cacheScript( $ifRefresh = FALSE )
	{
		if( $this->hasScript() )
		{
			$scriptFile =  $this->_dirNamespace().'/script.js';

			if( !$this->j()->mPubFileStore()->ifFileExists($scriptFile) || $ifRefresh )
			{
				$this->j()->mPubFileStore()->saveFile
				(
					$this->script(),

					$scriptFile
				);
			}

			$this->addScriptLink( $this->name(), $this->j()->mPubFileStore()->url().'/'.$this->_dirNamespace().'/script' );
		}

	}

	public function addStyleLink( $name, $url )
	{
		$this->mStyle()->add( $name, $url );
	}

	public function addGoogleFont( $fontName )
	{
		$this->mStyle()->addGoogleFont( $fontName );
	}

	public function addScriptLink( $name, $url )
	{
		$this->mScript()->add( $name, $url );
	}

}
