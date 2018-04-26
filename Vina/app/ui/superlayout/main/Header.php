<?php namespace app\ui\superlayout\main;

class Header extends \Jhul\Core\UI\View\Element\Composite
{
	public function __construct( $name)
	{
		parent::__construct($name);

		$this->growWidth()->setPadding(12);

		$this->addChild('logo_container')->growWidth();

		$this->child('logo_container')
			->addChild('logo', 'SYAHI')
				->setURL('<?= $this->app()->url() ?>' )
				->setPadding(12)
				->setFontSize(18)
				->setFontBold(18)
				->setColor('#c0c6cb')
		;



		// $this->compile();
		//
		// ob_clean();
		// echo '<pre>';
		// echo '<br/> File : <br/>'.__FILE__.':'.__LINE__.'</br></br>';
		// var_dump( $this->show() );
		// echo '</pre>';
		// exit();
	}
}
