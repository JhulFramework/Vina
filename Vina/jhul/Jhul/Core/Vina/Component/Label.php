<?php namespace Jhul\Core\UI\Component;

class Label extends \Jhul\Core\UI\View\Element
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->setText('Text');

		$this->center();

		$this->growWidth();

	}

	public function setText( $label )
	{
		return $this->setContent( $label );
	}
}
