<?php namespace Jhul\Core\Vina\View\Style\Param;


trait _PositionSelf
{

	public function setPositionAbsolute()
	{
		return $this->_styleSet('position', 'absolute');
	}

	public function setPositionRelative()
	{
		return $this->_styleSet('position', 'relative');
	}

	public function setLeft( $unit )
	{
		return $this->_styleSetUnit('left', $unit );
	}

	public function setTop( $unit )
	{
		return $this->_styleSetUnit('top', $unit );
	}

	public function setRight( $unit )
	{
		return $this->_styleSetUnit('right', $unit );
	}

	public function setBottom( $unit )
	{
		return $this->_styleSetUnit('bottom', $unit );
	}
}
