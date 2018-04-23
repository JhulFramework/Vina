<?php namespace app\ui\component\user\profile;

class UserInfoContainer extends \Jhul\Core\UI\Element\Composite
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->growHeight();
		$this->setContent( new UserInfoContent('user_info_content') );
		$this->centerY();

		$this->setWidth('50%');


		$this->onMaxScreenWidth(720)
		->setPositionAbsolute()
		->setZIndex(5)
		->center()
		->setWidth('100%');
	}
}
