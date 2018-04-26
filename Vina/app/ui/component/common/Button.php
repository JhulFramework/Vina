<?php namespace app\ui\component\common;

abstract class Button extends \Jhul\Core\UI\Component\IconLabel\IconLabel
{
	public function __construct( $name )
	{
		parent::__construct($name);
		$this->border()->none();
		$this->setPadding(0);
		
	}

	public function tagKey() { return 'button' ; }
}
