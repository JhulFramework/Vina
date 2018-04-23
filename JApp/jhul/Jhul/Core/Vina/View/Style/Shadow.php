<?php namespace Jhul\Core\Vina\View\Style;


class Shadow
{

	private $_size = '0px';

	private $_blur = '0px';

	private $_shiftX = '0px';

	private $_shiftY = '0px';

	private $_color;

	public function __construct()
	{
		$this->setColor('000');
		$this->setBlur('3');
	}

	public function setColor( $color, $opacity = 1 )
	{
		$this->_color = Color::toRGBA($color, $opacity);
		return $this ;
	}

	public function setShiftY( $unit )
	{
		$this->_shiftY = $unit.'px';
		return $this ;
	}

	public function setShiftX( $unit )
	{
		$this->_shiftX = $unit.'px';
		return $this ;
	}

	public function setBlur( $unit )
	{
		$this->_blur = $unit.'px';
		return $this ;
	}

	public function setSize( $unit )
	{
		$this->_size = $unit.'px';
		return $this ;
	}


	private function _make()
	{
		return $this->_shiftX.' '.$this->_shiftY.' '.$this->_blur.' '.$this->_size.' '.$this->_color  ;
	}

	public function compile()
	{
		$param = $this->_make();

		return '-webkit-box-shadow:'.$param.';-moz-box-shadow: '.$param.';box-shadow: '.$param.' ;';
	}


}
