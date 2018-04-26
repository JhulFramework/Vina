<?php namespace Jhul\Core\UI\Component\Form\Field;


class EditTextBig extends \Jhul\Core\UI\Element
{
	use \Jhul\Core\UI\Component\Form\_Input;

	public function __construct( $name )
	{
		parent::__construct($name);
		$this->setPadding(12);
		$this->setFontSize(14);
		$this->setLineHeight('1.5em');
		$this->setBackground('#20262b');
		$this->setOpacity('0.8');
		$this->border()->none();
		$this->setColor('#e0e6eb');

		$this->setAttribute('rows', 12);
	}

	public function beforeCompile()
	{
		$this->setAttribute( 'name', $this->formFieldName() );
		parent::beforeCompile();
	}

	public function compileContent()
	{
		 return '<?= $'.$this->form()->variableName().'->restore(\''.$this->name().'\'); ?>' ;
	}

	public function tagKey() { return 'textarea' ; }

	public function viewType()
	{
		return 'editTextBig' ;
	}
}
