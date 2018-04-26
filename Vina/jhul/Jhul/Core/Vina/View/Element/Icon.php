<?php namespace Jhul\Core\Vina\View\Element;


class Icon extends \Jhul\Core\UI\View\Element
{
	public function __construct( $name, $content = '' )
	{
		parent::__construct( $name, $content );
		$this->center();
		$this->setSize(12);
		$this->setColor('#e0e6eb');

		$this->setIcon('feather');

	}

	public function setIcon( $icon )
	{
		if( FALSE === strpos( $icon, 'icon-' ) )
		{
			$icon = 'icon-'.$icon;
		}

		return $this->setContent('<i class="'.$icon.'"></i>');
	}

	public function setSize($unit)
	{
		$this->setFontSize($unit);
		$this->setHeight($unit);
		$this->setWidth($unit);
	//	$this->_styleSetUnit('line-height', $unit);
		return $this ;
	}

	public function setCircular()
	{
		$this->border()->setRadius('50%');
		return $this ;
	}

}
