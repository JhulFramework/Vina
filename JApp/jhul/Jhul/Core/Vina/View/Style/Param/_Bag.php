<?php namespace Jhul\Core\Vina\View\Style\Param;


class _Bag
{
	protected $_params = [];

	public function set( $key, $value )
	{
		$this->_params[$key] = $value;
		return $this ;
	}

	public function compile()
	{
		$style = '';

		foreach ( $this->_params as $key => $value)
		{
			$style .= $key.':'.$value.';';
		}

		return  $style;
	}

	public function setUnit( $key, $value )
	{
		$this->_params[$key] = $this->_touchUnit($value);
		return $this;
	}

	private function _touchUnit( $value )
	{
		if( (FALSE === strpos($value, 'px')) && (FALSE === strpos($value, 'em')) && (FALSE === strpos($value, '%')) )
		{
			$value = $value.'px';
		}

		return $value ;
	}

	public function isEmpty()
	{
		return empty($this->_params) ;
	}
}
