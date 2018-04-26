<?php namespace Jhul\Core\UI\Component\Form\Field;

class Token extends \Jhul\Core\UI\View\Element
{

	use \Jhul\Core\UI\Component\Form\_Input;

	public function __construct( $name )
	{
		parent::__construct($name);
		$this->setAttribute( 'type', 'hidden' );
	}

	public function beforeCompile()
	{
		$this->setAttribute( 'name', $this->formFieldName() );
		$this->setAttribute( 'value', '<?= $'.$this->form()->variableName().'->token()->value() ?>' );
		parent::beforeCompile();
	}

	public function wrapContent( $con )
	{
		return '<input'.$this->attributes().' />';
	}

	public function viewType()
	{
		return 'formToken' ;
	}



}
