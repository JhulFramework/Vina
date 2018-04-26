<?php namespace app\ui\component\user\profile;

class Cover extends \Jhul\Core\UI\Element\Composite
{
	public function __construct( $name )
	{
		parent::__construct($name);
		$this->growHeight();
		$this->setContent('');
		$this->setBackground('#20262b');
		$this->setDisplayHidden();


		$this->onMaxScreenWidth(720)
		->setWidth('100%')
		->setDisplayFlex()
		->setZIndex(4)
		->setPositionAbsolute()
		->setOpacity('0.3')
		;
	}
}
