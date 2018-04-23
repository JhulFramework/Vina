<?php namespace app\ui\component\article\create\button;

abstract class B extends \Jhul\Core\UI\_Design\_Layout
{

	use \Jhul\Core\UI\_Design\Style\_Styleable;

	const POSITION_LEFT = 'left';
	const POSITION_RIGHT = 'right';

	private $_iconPosition;

	private $_variableParams =
	[
		'labelColor' => '#fff',
		'iconColor' => '#fff',
	];

	//label Object
	private $_oLabel;

	private $_oIcon;

	public function __construct( $name )
	{
		parent::__construct( $name );

		$this->_loadDefaults();

		$this->center();

		$this->setBackground('#CC0044');
	}

	private function _loadDefaults()
	{
		//$this->setFragment( 'icon', $this->icon() );
		$this->setFragment( 'layout_name', $this->name() );
		$this->setFragment( 'label', $this->label() );
	}

	public function layout()
	{
		return 'layout' ;
	}


	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	final public function oLabel()
	{
		if( empty($this->_oLabel) )
		{
			$this->_oLabel = (new Label('label'))->setText($this->label());
			$this->_oLabel->_mSelfStyle()->setParentClass( $this->superClass()  );
			$this->_oLabel
			->setPaddingH(6)
			->setPaddingV(10)
			->setColor('#fff')
			//->setBackground('green')
		//	->setFontFamily('Itim')
			->setFontSize(15);

		}

		return $this->_oLabel ;
	}

	final public function oIcon()
	{
		if( empty($this->_oIcon) )
		{
			//$this->_oIcon = (new Label($this->name().'_label'))->setText($this->label());
			$this->_oIcon = $this->_mui()->createUI( 'icon', 'icon' );
			$this->_oIcon->_mSelfStyle()->setParentClass( $this->superClass()  );

			$this->_oIcon->setPaddingH(3)
			->setColor('#e0e6eb')
//			->setBackground('blue')
			->setIcon($this->icon())
			->setFontSize(12);
		}

		return $this->_oIcon ;
	}

	public function setLabel( $text )
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
			$this->setFragment('right', $this->oIcon() );
			$this->setFragment('left', $this->oLabel() );
		}
		else
		{
			$this->setFragment('right', $this->oLabel() );
			$this->setFragment('left', $this->oIcon() );
		}

		$this->setFragment( 'superClass', $this->name() );
		$this->setVariableParam('superClass', $this->name() );


	}

	public function superClass()
	{
		return  $this->name();
	}

	public function useStyles()
	{
		return ['layout', 'color'] ;
	}

	public abstract function label();
	public abstract function icon();


}
