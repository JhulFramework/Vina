<?php namespace app\ui\component\titlebar;

abstract class _Class extends \Jhul\Core\UI
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->setWidthFull();

		$this->addLink('back', 'HOME' );
		$this->child('back')->setURL( $this->app()->url() );

		$this->child('back')->setContentPadding(12);
		$this->child('back')->setContentBackground('green');

		$this->add('title', $this->title() );
		$this->add('title2', $this->title() );


		$this->child('title')->setBackground('blue');
		$this->child('title')->autoExpandWidth();

		$this->child('title')->setContentBackground('pink');
	}
}
