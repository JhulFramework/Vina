<?php namespace _m\main\context\error404_\ui;


class Layout extends \Jhul\Core\UI\Element\Composite
{
	public function beforeCompile()
	{
		$this->grow()->center()->growHeight();


		$this->setFlexDirectionColumn();
		$this->add( 'face', '( ^_^ )')->center()->setFontSize(120)->grow();
		$this->add( 'label', 'PAGE NOT AVAILABLE' )->center()->setFontSize(24);
		$this->add( 'code', '404' )->center()->setFontSize(36)->grow();
	}
}
