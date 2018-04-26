<?php namespace Jhul\Core\UI\Component\PageNavigator;

abstract class V extends \Jhul\Core\UI\Element\Composite
{
	private $_nextButtonLabel = '';
	private $_previouButtonLabel = '';

	private $_nButton ;
	private $_pButton ;

	public function __construct( $name )
	{
		parent::__construct($name);
		$this->setPaddingH(24);
		$this->grow();

		$this->createContainers();

		$this->_nButton = $this->_mui()->createUI( 'iconLabel','nextButton')
		->setLabel( $this->nextButtonLabel() )
		->setURL( $this->nextButtonURL() )
		->setIcon('right')
		->setBackground($this->buttonBackground())
		->setColor($this->textColor())
		->setBorder($this->buttonBorder())
		->setIconRight()
		;

		$this->_pButton = $this->_mui()->createUI( 'iconLabel', $this->name().'previousButton')

		->setLabel( $this->previousButtonLabel() )
		->setIcon('left')
		->setBackground($this->buttonBackground())
		->setColor($this->textColor())
		->setBorder($this->buttonBorder())
		->setURL( $this->previousButtonURL() );

	}

	private function createContainers()
	{
		$this->add( 'left' )->grow()->center();
		$this->add( 'center' )->center();
		$this->add( 'right' )->grow()->center();
	}

	private function _l()
	{
		return $this->child('left') ;
	}

	private function _r()
	{
		return $this->child('right') ;
	}

	abstract public function nextButtonURL();

	abstract public function previousButtonURL();

	public function nextButtonLabel()
	{
		return 'अगला' ;
	}

	public function previousButtonLabel()
	{
		return 'पिछला' ;
	}

	public function beforeCompile()
	{

		$this->_l()->add( 'prebtn_cntnr', $this->_pButton );
		$this->_r()->add( 'nxtbtn_cntnr', $this->_nButton );
	//	$this->_setSelfStyle('justify-content', 'space-between');

	}

	public function buttonBackground()
	{
		return 'transparent' ;
	}

	public function textColor()
	{
		return '#d0d6db' ;
	}

	public function buttonBorder()
	{
		return '1px dashed #b0b6bb' ;
	}
}
