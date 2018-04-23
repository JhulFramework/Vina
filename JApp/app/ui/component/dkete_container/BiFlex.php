<?php namespace app\ui\component\container;

class Layout extends \Jhul\Core\UI\Element\Composite
{
	public function __construct( $name, $content = '' )
	{
		parent::__construct($name, $content);
		$this->growHeight();
		$this->grow();
		$this->center();
asds
		$this->addChild('left')->setWidth('50%')->setBackground('green');

		$this->addChild('right')->setWidth('50%');
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

	public function left()
	{
		return $this->child('right') ;
	}

	public function setRightContent( $content  )
	{
		$this->right()->setContent($content);
		return $this ;
	}
}
