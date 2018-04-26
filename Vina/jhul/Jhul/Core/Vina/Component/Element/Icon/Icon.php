<?php namespace Jhul\Core\UI\Component\Element\Icon;

class Icon extends \Jhul\Core\UI\Element
{
	public function __construct( $name, $content = '' )
	{
		parent::__construct($name);

		$this->setIcon( 'feather' );

		$this->setDisplayFlex();

		$this->center();

	}

	public function setIcon( $iconClass )
	{
		return $this->setContent( '<i class="icon-'.$iconClass.'" ></i>' );
	}

	public static function _create( $name, $icon )
	{
		return  (new static( $name ))->setIcon($icon);
	}
}
