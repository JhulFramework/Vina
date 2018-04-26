<?php namespace Jhul\Core\UI\Component\Form;

class Label extends \Jhul\Core\UI\Element
{
	use \Jhul\Core\UI\_Design\_HasAttributes;

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

	public function setFor($field)
	{
		$this->setAttribute('for', $field);
	}
}
