<?php namespace app\ui\component\article;

class Actionbar extends \Jhul\Core\UI\Element\Composite
{

	private $_button;

	public function __construct( $name )
	{
		parent::__construct($name);

		$this->setDisplayFlex();

		$this->grow();

		$this->add( 'left' )->setDisplayFlex()->center();
		$this->add( 'right' )->setDisplayFlex()->center();

		$this->setPaddingH('24px');

		$this->_styleSet('justify-content', 'space-between');
	}


	public function createButton( $name )
	{
		$this->_button = $this->_mui()->createUI('iconLabel', $name);
		return $this->_button ;
	}

	public function beforeCompile()
	{

		$this->_button->compile();

		$this->child('right')->add( $this->_button );
	}

}
