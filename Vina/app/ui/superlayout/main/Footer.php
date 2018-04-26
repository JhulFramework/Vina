<?php namespace app\ui\superlayout\main;

class Footer extends \Jhul\Core\UI\View\Element\Composite
{
	public function __construct( $name)
	{
		parent::__construct($name);
		$this
		->center()
		->growWidth()
		// ->setHeight(36)
		// ->setLineHeight(36)
		->setPaddingV(12)
		;


		$this->addChild('c', '&copy;')
		//->setParentStyleClass($name)

		->setFontFamily('Gugi')
		->setFontSize(14)
		//->setPaddChildingH()
		;



		$this->addChild('y', '<?= date(\'Y\', time() ); ?>')
		->setFontFamily('Gugi')
		->setFontBold()
		->setPaddingH(6)
		//->setParentStyleClass($name)
		->setFontSize(10)
		//->setPaddChildingH(2)
		;


		$this->addChild('w', 'SYAHI')
		->setFontFamily('Gugi')

		->_styleSet('letter-spacing', '1px')

		//->setParentStyleClass($name)
		->setFontSize(10)->setPaddingH(2)->setFontBold();



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
