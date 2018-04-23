<?php namespace app\ui\component\article\create\button;

class Label extends \Jhul\Core\UI\Element
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->setText('Text');

		$this->center();

		$this->grow();

	}


	public function setText( $label )
	{
		return $this->setContent( $label );
	}

}
