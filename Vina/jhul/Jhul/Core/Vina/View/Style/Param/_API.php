<?php namespace Jhul\Core\Vina\View\Style\Param;



trait _API
{
	final public function _styleSet( $key, $value = '' )
	{
		if( is_array($key) )
		{
			foreach ($key as $k => $v)
			{
				$this->_styleSet($k, $v);
			}

			return $this ;
		}

	 	$this->paramBag()->set($key, $value);

		return $this ;
	}

	final public function _styleSetUnit( $key, $value = '' )
	{
		if( is_array($key) )
		{
			foreach ($key as $k => $v)
			{
				$this->_styleSetUnit($k, $v);
			}

			return $this ;
		}

	 	$this->paramBag()->setUnit($key, $value);

		return $this ;
	}

	abstract public function paramBag();

	public function enableWordWrap()
	{
		 return $this->_styleSet('word-break', 'break-all');
	}

	public function enableWrap()
	{
		 return $this->_styleSet
		 ([
			 'flex-wrap' => 'wrap',
			 '-webkit-flex-wrap' => 'wrap'
		 ]);

	}

	public function setBackground( $value )
	{
		return $this->_styleSet('background', $value);
	}

	public function setColor( $value )
	{
		return $this->_styleSet('color', $value);
	}

	public function setFontSize( $unit )
	{
		return $this->_styleSetUnit('font-size', $unit);
	}

	public function setFontBold()
	{
		return $this->_styleSet('font-weight', 'bold');
	}


	public function setPadding( $unit )
	{
		return $this->_styleSetUnit('padding', $unit);
	}


	public function setPaddingH( $value )
	{
		return $this->_styleSetUnit
		([
			'padding-left' 	=> $value,
			'padding-right'	=> $value,
		]);
	}

	public function setPaddingV( $value )
	{
		return $this->_styleSetUnit
		([
			'padding-top' 	=> $value,
			'padding-bottom'	=> $value,
		]);
	}

	public function growWidth()
	{
		return $this->_styleSet('flex', '1');
	}

	public function growHeight()
	{
		return $this->_styleSet('height', '100%');
	}

	public function alignItemsRight()
	{
		return $this->_styleSet('justify-content', 'right');
	}

	public function alignItemsLeft()
	{
		return $this->_styleSet('justify-content', 'left');
	}

	public function setWidth( $unit )
	{
		return $this->_styleSetUnit('width', $unit) ;
	}

	public function setHeight( $unit )
	{
		return $this->_styleSetUnit('height', $unit) ;
	}

	public function setLineHeight( $unit )
	{
		return $this->_styleSetUnit('line-height', $unit) ;
	}

	public function setMinHeight( $unit )
	{
		return $this->_styleSetUnit('min-height', $unit) ;
	}

	public function centerY()
	{
		return $this->_styleSet('align-items', 'center');
	}

	public function centerX()
	{
		return $this->_styleSet('justify-content', 'center');
	}

	public function selfAlignCenter()
	{
		return $this->_styleSet
		([
			'align-self' => 'center',
			'-webkit-align-self' => 'center'
		]);

	}

	public function selfAlignEND()
	{
		return $this->_styleSet
		([
			'align-self' => 'end',
			'-webkit-align-self' => 'end'
		]);

	}

	public function center()
	{
		$this->centerY();
		$this->centerX();
		return $this ;
	}

	public function setDisplayFlex()
	{
		return  $this->_styleSet
		([
			'display' => '-webkit-flex',
			'display' => 'flex',
		]);
	}

	public function setDisplayBlock()
	{
		return  $this->_styleSet('display', 'block');
	}

	public function setDisplayHidden()
	{
		return  $this->_styleSet('display', 'hidden') ;
	}

	public function setZIndex( $unit )
	{
		return $this->_styleSet('z-index', $unit ) ;
	}

	public function setOpacity( $unit )
	{
		return $this->_styleSet('opacity', $unit ) ;
	}

	public function setFontFamily( $name )
	{
		return  $this->_styleSet('font-family', $name);
	}

	public function setBorder( $border )
	{
		return $this->_styleSet('border', $border);
	}

	public function setPositionAbsolute()
	{
		return $this->_styleSet('position', 'absolute');
	}

	public function setPositionRelative()
	{
		return $this->_styleSet('position', 'relative');
	}

	public function setMaxHeight( $unit )
	{
		return $this->_styleSetUnit('max-height', $unit) ;
	}

	public function setMaxWidth( $unit )
	{

		return $this->_styleSetUnit('max-width', $unit) ;
	}

	public function setFlexDirectionColumn()
	{
		return $this->_styleSet('flex-direction', 'column') ;
	}

	public function setFlexDirectionRow()
	{
		return $this->_styleSet('flex-direction', 'row') ;
	}

	public function setLetterSpacing( $unit )
	{
		return $this->_styleSetUnit('letter-spacing',  $unit );
	}

	public function alignItemsEvenly()
	{
		return $this->_styleSet('justify-content',  'space-evenly' );
	}

	public function setMargin( $unit )
	{
		return $this->_styleSetUnit('margin', $unit) ;
	}

}
