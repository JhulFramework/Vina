<?php namespace Jhul\Core\UI\Component;

class Button extends \Jhul\Core\UI\_Design\_Class
{

	private $_p  =
	[
		'content' => 'submit',
	];

	public function set( $key, $value )
	{
		$this->_p[$key] = $value;
		return $this ;
	}


	public function p( $key )
	{
		return $this->_p[$key] ;
	}

	public function wrapperClass()
	{
		return 'buttonWrapper' ;
	}

	public function compileStyle(){}
	public function compileScript(){}

	public function compileContent()
	{

		return '<div class="'.$this->wrapperClass().'"><button '.$this->serializeAttributes().' >'.$this->p('content').'</button></div>';
	}
}
