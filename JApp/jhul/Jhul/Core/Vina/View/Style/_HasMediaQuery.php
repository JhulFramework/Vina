<?php namespace Jhul\Core\Vina\View\Style;



trait _HasMediaQuery
{
	private $_maxScreenSize = [];

	private $_minScreenSize = [];

	public function compileMediaQueries()
	{
		$style = '';

		foreach ( $this->_minScreenSize as $min )
		{
			$style .= $min->compile();
		}

		foreach ( $this->_maxScreenSize as $max )
		{
			$style .= $max->compile();
		}

		return $style ;
	}

	public function onMaxScreenWidth($size)
	{
		if(!isset($this->_maxScreenSize[$size]))
		{
			$this->_maxScreenSize[$size] = new MediaQuery( $this->viewObject(), 'max', $size );
		}

		return $this->_maxScreenSize[$size] ;
	}

	public function onMinScreenWidth($size)
	{

		if(!isset($this->_minScreenSize[$size]))
		{
			$this->_minScreenSize[$size] = new MediaQuery( $this->viewObject(), 'min', $size );
		}

		return $this->_minScreenSize[$size] ;
	}

}
