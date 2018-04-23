<?php namespace app\ui\component\user\profile;

class HomeIcon extends \Jhul\Core\UI\Element\Icon
{
	use \Jhul\Core\UI\_Design\Style\Param\_PositionSelf;

	public function __construct( $name )
	{
		parent::__construct($name);

		$this->setSize(20)->setURL('<?= $this->app()->url() ?>')->setPadding(12);

		$this->setBackground('#c04');
		$this->shadow()->setColor('#000')->setBlur(6)->setSize(2);
		$this->setCircular();

		$this->setPositionAbsolute();
		$this->setTop('6%');
		$this->setRight('3%');

	}
}
