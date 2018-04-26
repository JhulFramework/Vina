<?php namespace app\ui\component\container\flex;

class Layout extends \Jhul\Core\UI\Type\Element\Element
{
	public function __construct( $name, $content = '' )
	{
		parent::__construct($name, $content);
		$this->growHeight();
		$this->autoExpandWidth();
	}
}
