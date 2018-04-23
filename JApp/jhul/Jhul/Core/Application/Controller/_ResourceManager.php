<?php namespace Jhul\Core\Application\Page;

abstract class _ResourceManager
{
	use \Jhul\Core\_AccessKey;

	protected $_links = [] ;

	protected $_codes = [];

	protected $_ifCompiled = FALSE;

	protected $_compiled ='';

	protected $_dirNamespace = '';

	private $_page;

	public function __construct( $page )
	{
		$this->_page = $page;
	}

	public function add( $key, $value )
	{
		$this->_codes[$key] = $value;
	}


	public function dirNamespace()
	{
		return $this->_page->dirNamespace().'/'.$this->fileBasename() ;
	}

	abstract function wrapLink( $url);



	public function toString()
	{
		return implode( '', $this->_codes );
	}



	// public function compile()
	// {
	// 	if( $this->ifCreateCache() )
	// 	{
	// 		return $this->serializeLinks() ;
	// 	}
	//
	// 	return $this->serializeLinks().$this->makeEmbedded() ;
	// }

	public function ifCreateCache()
	{
		if( $this->pubFileStore()->hasWriteAccess() )
		{
			$this->pubFileStore()->saveFile( $this->serializeCodes(), $this->dirNamespace().'.'.$this->fileExtenstion() );

			if( $this->pubFileStore()->ifFileExists( $this->dirNamespace().'.'.$this->fileExtenstion()) )
			{
				$this->addLink( $this->_dirNamespace, $this->pubFileStore()->url().'/'.$this->dirNamespace() );

				return TRUE ;
			}
		}
	}

	abstract function fileBasename();
	abstract function fileExtension();

	public function pubFileStore()
	{
		return $this->j()->mPubFileStore() ;
	}

}
