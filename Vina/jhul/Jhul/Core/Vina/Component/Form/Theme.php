<?php namespace Jhul\Core\UI\Component\Form;

class Theme
{
	private $formView;

	public function __construct( $formView )
	{
		$this->formView = $formView;
	}


	public function applyStyleToField( $field )
	{

		$field->addStyleClass( $this->fieldStyle()->style()->selectorKey() );

		if( $field->input()->viewType() == 'editText' ||  $field->input()->viewType() == 'password'  )
		{
			$field->input()->addStyleClass( $this->editText()->style()->selectorKey() );
		}

		return $field ;
	}

	public function password()
	{
		return $this->editText() ;
	}

	public function fieldStyle()
	{
		if( !$this->formView->hasSubStyle('fieldCStyle') )
		{
			$this->formView->createSubStyle('fieldCStyle');
			$this->createFieldStyle();
		}

		return $this->formView->subStyle('fieldCStyle') ;
	}


	public function editText()
	{
		if( !$this->formView->hasSubStyle('editText') )
		{
			$this->formView->createSubStyle('editText');
			$this->createEditTextStyle();
		}

		return $this->formView->subStyle('editText') ;
	}

	private function createEditTextStyle()
	{
		$this->editText()
		->setPadding(12)
		->setFontSize(15)
		->setBackground('#20262b')
		->setOpacity('0.8')
		->setColor('#e0e6eb')
		->border()->none()
		;
	}

	private function createFieldStyle()
	{
		$this->fieldStyle()
		->setWidth('100%')
		->setFlexDirectionColumn()
		->setPaddingV(6)
		;
	}

}
