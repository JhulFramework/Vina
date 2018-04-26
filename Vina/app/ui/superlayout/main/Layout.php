<?php namespace app\ui\superlayout\main;

class Layout extends \Jhul\Core\UI\SuperLayout\_Class
{

	const HEADER_LAYOUT_NAME = 'super_header';
	const FOOTER_LAYOUT_NAME = 'super_footer';

	private $_ifUseHeader = TRUE;

	private $_mBreadCrumb;

	private $_uiVariables =
	[
		'article_content_font' => 'Roboto Mono'
	];

	public function __construct( $name )
	{
		parent::__construct($name);
		$this->setFragment( new Header(static::HEADER_LAYOUT_NAME ) );
		$this->setFragment( new Footer(static::FOOTER_LAYOUT_NAME ) );
	}


	public function newBreadCrumb( $hideHeader = FALSE )
	{
		if( $hideHeader )
		{
			return (new Breadcrumb('mbrdcrmb'))->addStyle( 'hideHeader', $this->header()->style()->hiddenStyle() );
		}

		return new Breadcrumb('mbrdcrmb');
	}

	public function disableHeader()
	{
		$this->_ifUseHeader = FALSE;
		return $this ;
	}

	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function template()
	{
		return 'layout' ;
	}

	public function styleResources()
	{
		return [ 'icons', 'icons-animation', 'height100', 'my_reset', 'app', 'color',  ] ;
	}

	public function scriptResources(){ return [] ; }

	public function setHeader( $header )
	{
		$this->_header = $header;
		return $this ;
	}

	public function header()
	{
		return $this->fragment(static::HEADER_LAYOUT_NAME);
	}

	public function footer()
	{
		return $this->fragment(static::FOOTER_LAYOUT_NAME);
	}

	public function setDefaultFonts( $fonts )
	{
		foreach ($fonts as $font)
		{
			$this->addGoogleFont( $font );
		}

		$this->setFontFamily( implode(', ', $fonts) );
	}

	public function beforeCompile()
	{


	
		$this->addGoogleFont('Product Sans');
		$this->addGoogleFont('Comfortaa');
		$this->addGoogleFont('Gugi');
		$this->addGoogleFont('Sarala');

		$this->setDefaultFonts( ['Comfortaa', 'Biryani' ] );

		//$this->setFontFamily('Comfortaa, Pragati Narrow');

		foreach ( $this->_uiVariables  as $key => $value)
		{
			$this->setVariable( $key, $value );
		}

		$uiVariables = require( '_variables.php' );

		foreach ( $uiVariables  as $key => $value)
		{
			$this->setVariable( $key, $value );
		}

		parent::beforeCompile();
	}

	public function setFontFamily( $name )
	{
		$this->_uiVariables['font_family'] =  $name;
		return $this ;
	}

	public function setFontFamilyLabel( $name )
	{
		$this->_uiVariables['font_family_label'] =  $name;

		return $this ;
	}

}
