<?php namespace Jhul\Core\UI\Component\Form;

class Field extends \Jhul\Core\UI\View\Element\Composite
{

	private $_ifLabelSet = FALSE;

	private $_form;

	//html form field id
	private $_id ;

	private $_inputName;

	public function __construct( $inputView )
	{

		parent::__construct($inputView->name().'_field');

		$this->_inputName = $inputView->name();


		$this->addChild('label', 'label');
		$this->addChild( $inputView );
		$this->setId( $inputView->name() );
		//
		// $this->setFlexDirectionColumn();
		// $this->setWidth('100%');
		// $this->setPaddingV(6);

	// $this->style()->compile();
	//
	// 	ob_clean();
	// 	echo '<pre>';
	// 	echo '<br/> File : <br/>'.__FILE__.':'.__LINE__.'</br></br>';
	// 	var_dump( $this->style()->compile() );
	// 	echo '</pre>';
	// 	exit();

	}

	public function setForm( $form )
	{
		$this->_form = $form;
		return $this ;
	}

	public function setLabel( $label )
	{
		$this->_ifLabelSet = FALSE;

		if( !empty($label) )
		{
			$this->_ifLabelSet = TRUE;
			$this->label()->setContent($label)->setPaddingV(6);
		}

		return $this ;
	}

	public function setID( $id )
	{
		$this->input()->setAttribute('id', $id);
		return $this ;
	}

	public function label()
	{
		return $this->child('label');
	}

	public function input()
	{
		return $this->child( $this->_inputName );
	}

	public function beforeCompile()
	{

		$this->input()->setForm($this->_form);

		$this->label()->setAttribute('for', $this->_id );

		if( !$this->_ifLabelSet )
		{
			$this->removeChild('label');
		}

		$this->addChild('error', 'error' )->setContent('<?= $'.$this->_form->variableName().'->error(\''.$this->input()->name().'\') ?>');

		$this->child('error')->setHeight(26)->setFontSize(14)->centerY()->setColor('#f56');

		parent::beforeCompile();


	}
}
