<?php namespace Jhul\Core\UI\Page;

abstract class _Class extends \Jhul\Core\UI\View\Layout
{

	protected $_path;

	private $_mStyle;

	private $_mScript;

	private $_name;

	private $_ifUseSuperLayout = TRUE;

	private $_flags =
	[
		'showHeader' 	=> TRUE,

		'showBreadcrumbs' => FALSE,

		'useSuperLayout'	=> TRUE,
	];


	public function setFlag( $key, $bool )
	{
		if( !array_key_exists($key, $this->_flags) )
		{
			throw new \Exception( 'Flag "'.$key.'" Does Not Exists' , 1);
		}

		$this->_flags[$key] = ($bool === TRUE);
		return $this;
	}

	public abstract function ifEnableIndexing();

	public function ifUseSuperLayout()
	{
		return $this->_ifUseSuperLayout == TRUE ;
	}

	public function setIfUseSuperLayout( $bool )
	{
		$this->_ifUseSuperLayout = $bool;
		return $this ;
	}

	public function _hasSEOTag() { return FALSE ; }

	public function path()
	{
		if( empty($this->_path) )
		{
			$this->_path = $this->J()->fx()->dirPath(get_called_class());
		}

		return $this->_path;
	}

	abstract public function build();

	final public function _dirNamespace()
	{
		return $this->context()->_dirNamespace() ;
	}

	public function resDirPath()
	{
		return $this->path().'/res' ;
	}

	public function requiredScriptLibs()
	{
		return [] ;
	}

	public function breadCrumbs(){ return [] ; }

	public function loadBreadcrumbs( $setBreadcrumbHeader = TRUE )
	{
		$breadcrumb = $this->superLayout()->newBreadCrumb($setBreadcrumbHeader) ;

		foreach ( $this->breadCrumbs()  as $label => $url )
		{
			$breadcrumb->addBreadCrumb( $label, $url );
		}



		$this->prepend('brdcrmb', $breadcrumb);
	}
}
