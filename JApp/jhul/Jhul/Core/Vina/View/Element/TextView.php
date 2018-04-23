<?php namespace Jhul\Core\Vina\View\Element;


class TextView extends \Jhul\Core\UI\View\Element
{
	private $_ifContentPreFormatted = FALSE;

	public function __construct( $name, $content = '' )
	{
		parent::__construct( $name, $content );
		$this->centerY();
		$this->setPadding('12');

		$this->setFontSize(15);

		$this->setColor('#e0e6eb');

		$this->_styleSet( 'line-height', '1.2em' );

	}

	public function justifyContentCenter()
	{
		$this->_setSelfStyle( 'text-align', 'center' );
	}

	public function justifyContentLeft()
	{
		$this->_setSelfStyle( 'text-align', 'left' );
	}

	public function justifyContentRight()
	{
		$this->_setSelfStyle( 'text-align', 'right' );
	}

	public function setLineHeight( $unit )
	{

	}

	public function setPreFormatted( $bool )
	{
		$this->_ifContentPreFormatted = ($bool === TRUE);

		return $this ;
	}


	public function wrapContent($content)
	{
		if($this->_ifContentPreFormatted)
		{
			$content = '<p>'.$content.'</p>';
		}

		return '<div '.$this->attributes().' >'.$content.'</div>' ;
	}

}
