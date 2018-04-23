<?php namespace app\ui\superlayout\main;

class Breadcrumb extends \Jhul\Core\UI\Element\Composite
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->setDisplayFlex();

		$this->grow();

		$this->add( 'left' )->setDisplayFlex()->center()->enableWrap();
		$this->add( 'right' )->setDisplayFlex()->center();

		$this->setPaddingH('24px');

		$this->_styleSet('justify-content', 'space-between');

		$this->child('left')->add( 'home', 'स्याही' )->setURL( $this->appURl() );

		$this->setPaddingV(36);

		$this->setBackground('#30363b');

		$this->enableWrap();

		$this->setLineHeight('1.6em');

	}

	public function appURl()
	{
		return \Jhul::I()->app()->url();
	}

	private $_itemKeys =[];

	private $_lastItemKey ;
	private $_lastItemURL;

	public function addBreadCrumb( $label, $url = '' )
	{
		if( !empty($this->_lastItemKey) && !empty($this->_lastItemURL) )
		{
			$this->child('left')->child($this->_lastItemKey)->setURL( $this->_lastItemURL );
		}

		$this->_lastItemKey =  $this->generateItemKey();
		$this->_lastItemURL = $url;
		$this->child('left')->add('s_'.$this->_lastItemKey , '/')->setPaddingH(6)->setFontSize(12)->setFontBold();
		$this->child('left')->add( $this->_lastItemKey , $label );
	}

	public function generateItemKey()
	{
		$key = $this->randomKey( 4, 2 );

		return isset($this->_itemKeys[$key]) ? $this->generateItemKey() : $key;

	}

	public function randomKey( $length = 10, $charStrength = 0 )
	{
		$char = '0123456789';

		if( $charStrength > 0 )
			$char .= 'abcdefghijklmnopqrstuvwxyz';

		if( $charStrength > 1 )
			$char .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		if( $charStrength > 2 )
			$char .= '!@#$%^&*(){}.|!@#$%^&*(){}.|';

		$char = str_shuffle($char);

		$charactersLength = strlen($char);

		$randomString = '';

		for ($i = 0; $i < $length; $i++)
		{
			$randomString .= $char[ rand( 0, $charactersLength - 1 ) ];
		}

		return $randomString;
	}

	public function beforeCompile()
	{
		$this->child('left')->child($this->_lastItemKey)->setColor('#e0e6eb')->_styleSet('border-bottom', '2px solid #60666b' )->setPaddingV(6);
	}
}
