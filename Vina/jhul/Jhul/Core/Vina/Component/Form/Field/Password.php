<?php namespace Jhul\Core\UI\Component\Form\Field;


class Password extends \Jhul\Core\UI\View\Element
{
	use \Jhul\Core\UI\Component\Form\_Input;

	public function beforeCompile()
	{
		$this->setAttribute( 'type', 'password' );
		$this->setAttribute( 'name', $this->formFieldName() );
		$this->setAttribute( 'value', '<?= $'.$this->form()->variableName().'->restore(\''.$this->name().'\'); ?>');
		parent::beforeCompile();
	}

	public function wrapContent( $content )
	{
		return '<input '.$this->attributes().' />' ;
	}

	public function viewType()
	{
		return 'password' ;
	}
}
