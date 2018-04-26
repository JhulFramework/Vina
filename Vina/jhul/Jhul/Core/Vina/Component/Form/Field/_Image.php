<?php namespace Jhul\Core\UI\Component\Form\Field;

abstract class _Image extends \Jhul\Core\UI\Element
{
	use \Jhul\Core\UI\Component\Form\_Input;

	public function __construct( $name )
	{
		parent::__construct($name);
		$this->setAttribute( 'type', 'file' );
	}

	public function beforeCompile()
	{
		/*
		| resetting file name
		| file name cannot be array of form field
		*/
		$this->setAttribute('name', $this->name());
	}

	public function wrapContent( $content )
	{
		return '<input '.$this->attributes().' />' ;
	}

	public function viewType()
	{
		return 'imageInput' ;
	}
}
