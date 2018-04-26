<?php namespace app\ui\component\titlebar

class _Titlebar extends \Jhul\Core\UI\Element\Composite
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->setDisplayFlex();

		$this->grow();

		$this->add( 'left' )->setDisplayFlex()->center();
		$this->add( 'right' )->setDisplayFlex()->center();

		$this->setPaddingH('24px');

		$this->_mSelfStyle()->style()->set('justify-content', 'space-between');

		$this->child('right')->add( new CreateButton('siuca')  );


		//navigation
		$homeicon =  new \Jhul\Core\UI\Component\Element\Icon\Icon('homeicon');

		$homeicon->setIcon('back')
		->setURL( \Jhul::I()->app()->url() )
		->setColor('#e0e6ef')
		->setFontSize(20);


		$this->child('left')->add($homeicon);
		$this->child('left')->add('navarticle', '/ ARTICLES ')->setPaddingH(6);

		$this->setPaddingV(12);

	}

	public function createNavigation()
	{
		$icon =  new \Jhul\Core\UI\Component\Element\Icon\V('homeicon');

		return $this->child('left')->add($icon);
	}

	public abstract function navigationMap()

}
