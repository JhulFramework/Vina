<?php namespace Jhul\Core\UI\Component\IconLabel;


class IconLabel extends \Jhul\Core\UI\View\Layout
{
	const POSITION_LEFT = 'left';
	const POSITION_RIGHT = 'right';

	private $_iconPosition;

	//label Object
	private $_oLabel;

	private $_oIcon;

	public function ifBindContent(){ return TRUE ; }

	public function __construct( $name )
	{

		parent::__construct( $name );

		$this->_loadDefaults();

		$this->centerY();

		$this->setBackground('#bb0044');

		$this->setFlexDirectionRow();
		$this->setButtonHeight(36);

	}

	private function _loadDefaults()
	{

		// $this->addView( $this->name() );
		// $this->addView( $this->label() );
	}




	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	final public function oLabel()
	{
		if( empty($this->_oLabel) )
		{
			$this->_oLabel = $this->_mUI()->createUI('label', 'label')->setText($this->label());
			$this->_oLabel
			->center()

			->growWidth()
			->setColor('#fff')
			->setFontSize(15);
		}

		return $this->_oLabel ;
	}

	public function setButtonHeight( $unit )
	{


		$this->setHeight($unit);
		$this->setLineHeight($unit);
		$this->oIcon()->setHeight($unit);
		$this->oIcon()->setWidth($unit);

		$this->oLabel()->setHeight($unit);


	}

	final public function oIcon()
	{
		if( empty($this->_oIcon) )
		{

			$this->_oIcon = $this->_mui()->createUI( 'icon', 'icon' );

			$this->_oIcon
			->center()
			->setColor('#e0e6eb')
			->setIcon($this->icon())
			->setFontSize(16);
		}

		return $this->_oIcon ;
	}

	public function setColor( $color )
	{
		$this->_oIcon->setColor($color);
		$this->_oLabel->setColor($color);
		return $this ;
	}

	public function setIcon( $icon )
	{
		$this->oIcon()->setIcon($icon);
		return $this ;
	}


	public function setLabel( $text )
	{
		$this->oLabel()->setText($text);
		return $this ;
	}

	public function setText( $text )
	{
		$this->oLabel()->setText($text);
		return $this ;
	}


	public function setIconLeft()
	{
		$this->_iconPosition = static::POSITION_LEFT;
		return $this ;
	}

	public function setIconRight()
	{

		$this->_iconPosition = static::POSITION_RIGHT;



		return $this ;
	}



	public function beforeCompile()
	{
		if( $this->_iconPosition == static::POSITION_RIGHT  )
		{

			$this->addView( $this->oLabel()->_styleSetUnit('padding-left', 12) );
			$this->addView( $this->oIcon() );


		}
		else
		{
			$this->addView( $this->oIcon() );
			$this->addView( $this->oLabel()->_styleSetUnit('padding-right', 12 ) );


		}

		$this->setStyleVariable( 'layoutStyleSelector', $this->style()->selector() );

		parent::beforeCompile();
	}

	public function superClass()
	{
		return  $this->name();
	}

	public function styleResources()
	{
		return ['layout'] ;
	}

	public function label()
	{
		return 'setLabel(\'label\')' ;
	}

	public function icon()
	{
		return 'feather' ;
	}


	public function template(){}

}
