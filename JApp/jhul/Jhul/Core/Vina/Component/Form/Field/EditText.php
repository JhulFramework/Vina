<?php namespace Jhul\Core\UI\Component\Form\Field;


class EditText extends \Jhul\Core\UI\View\Element
{
	use \Jhul\Core\UI\Component\Form\_Input;

	public function __construct( $name )
	{
		parent::__construct($name);
		// $this->setPadding(12);
		// $this->setFontSize(15);
		// $this->setBackground('#20262b');
		// $this->setOpacity('0.8');
		// $this->border()->none();
		// $this->setColor('#e0e6eb');
	}

	public function beforeCompile()
	{
		$this->setAttribute( 'type', 'text' );
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
		return 'editText' ;
	}
}
