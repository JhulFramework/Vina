<?php namespace Jhul\Core\UI\Component\Form;

trait  _Input
{
	private $_form;

	public function setForm($form)
	{
		$this->_form = $form;
		return $this ;
	}

	final public function form()
	{
		return $this->_form ;
	}

	public function formFieldName()
	{
		return $this->form()->name().'['.$this->name().']' ;
	}

	abstract public function viewType();
}
