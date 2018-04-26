<?php namespace app\ui\component\user\profile;

class Name extends \Jhul\Core\UI\Element\Composite
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->setContent('<?= $host->name() ?>');

	//	$this->setFontBold();

		$this->setColor('#d0d6db');

		$this->setFontFamily('Product Sans');
		//$this->setFontFamily('Comfortaa');

//		$this->setFontBold();

		//$this->_styleSet('text-transform', 'uppercase');

		$this->setFontSize(36);

		$this->onMaxScreenWidth(720)->center();

		}
}
