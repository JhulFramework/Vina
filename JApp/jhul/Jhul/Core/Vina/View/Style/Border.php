<?php namespace Jhul\Core\Vina\View\Style;


class Border
{
	private $_style ;

	private $_radius =
	[
		'topLeft' 		=> '0px',
		'topRight'	 	=> '0px',
		'bottomRight' 	=> '0px',
		'bottomLeft' 	=> '0px',
	];

	public $ifRadiusIsSet = FALSE;

	public function __construct()
	{
		$this->_style = new Param\_Bag;
	}

	private function _touchUnit( $value )
	{
		if( (FALSE === strpos($value, 'px')) && (FALSE === strpos($value, 'em')) && (FALSE === strpos($value, '%')) )
		{
			$value = $value.'px';
		}

		return $value ;
	}

	public function setRadius( $unit)
	{
		return $this
		->setRadiusTopLeft($unit)
		->setRadiusTopRight($unit)
		->setRadiusBottomRight($unit)
		->setRadiusBottomLeft($unit);
	}

	public function setRadiusTopLeft( $unit )
	{
		$this->ifRadiusIsSet = TRUE;
		$unit = $this->_touchUnit($unit);
		$this->_radius['topLeft'] = $unit;
		return $this;

	}

	public function setRadiusTopRight( $unit )
	{
		$this->ifRadiusIsSet = TRUE;
		$unit = $this->_touchUnit($unit);
		$this->_radius['topRight'] = $unit;
		return $this ;
	}

	public function setRadiusBottomLeft( $unit )
	{
		$this->ifRadiusIsSet = TRUE;
		$unit = $this->_touchUnit($unit);
		$this->_radius['bottomLeft'] = $unit;
		return $this;
	}

	public function setRadiusBottomRight( $unit )
	{
		$this->ifRadiusIsSet = TRUE;
		$unit = $this->_touchUnit($unit);
		$this->_radius['bottomRight'] = $unit;
		return $this;
	}

	private function loadRadius()
	{
		if( !$this->ifRadiusIsSet ) return '' ;

		$u = implode(' ', $this->_radius);

		$this->_styleSet('border-radius', $u);
		$this->_styleSet('-moz-border-radius', $u);
		$this->_styleSet('-webkit-border-radius', $u);
	}

	public function setColor( $color)
	{
		return $this->_styleSet('border-color', $color );
	}

	public function setColorLeft( $color)
	{
		return $this->_styleSet('border-left-color', $color );
	}

	public function setColorRight( $color)
	{
		return $this->_styleSet('border-right-color', $color );
	}

	public function setColorTop( $color)
	{
		return $this->_styleSet('border-top-color', $color );
	}

	public function setColorBottom( $color)
	{
		return $this->_styleSet('border-bottom-color', $color );
	}

	public function setWidth( $unit)
	{
		return $this->_styleSetUnit('border-width', $unit );
	}

	public function setStyleSolid()
	{
		return $this->_styleSet('border-style', 'solid' );
	}

	public function setStyleDashed()
	{
		return $this->_styleSet('border-style', 'dashed' );
	}

	private function _styleSet( $key, $value )
	{
		$this->_style->set($key, $value);
		return $this ;
	}

	private function _styleSetUnit( $key, $value )
	{
		$this->_style->setUnit($key, $value);
		return $this ;
	}


	public function compile()
	{
		$this->loadRadius();
		return $this->_style->compile() ;
	}

	public function none()
	{
		$this->_style->set('border', 'none');
	}
}
