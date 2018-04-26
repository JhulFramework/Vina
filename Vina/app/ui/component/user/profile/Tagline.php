<?php namespace app\ui\component\user\profile;

class Tagline extends \Jhul\Core\UI\Element\TextView
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->setContent('<?= $host->tagline() ?>');

	//	$this->setFontBold();

		$this->setColor('#a0a6ab');

		//$this->setFontFamily('Handlee');

		$this->setFontSize(18);

		$this->setPadding(0);

		$this->setPreFormatted(TRUE);

	}
}
