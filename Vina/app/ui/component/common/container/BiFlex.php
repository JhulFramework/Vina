<?php namespace app\ui\component\common\container;

class BiFlex extends \Jhul\Core\UI\View\Element\Composite
{
	public function __construct( $name, $content = '' )
	{
		parent::__construct($name, $content);
		$this
		->growHeight()
		->growWidth()
		->enableWrap()
		->center();

		$this->addChild('left')
		->setWidth('50%')
		->center()
	
		->onMaxScreenWidth(720)->setWidth('100%')
		;



		$this->addChild('right')
		->center()
		->setWidth('50%')
		->onMaxScreenWidth(720)->setWidth('100%')
		;
	}

	public function left()
	{
		return $this->child('left') ;
	}

	public function setLeftContent( $content  )
	{
		$this->left()->setContent($content);
		return $this ;
	}

	public function right()
	{
		return $this->child('right') ;
	}

	public function setRightContent( $content  )
	{
		$this->right()->setContent($content);
		return $this ;
	}
}
