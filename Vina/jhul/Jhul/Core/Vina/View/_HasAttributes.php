<?php namespace Jhul\Core\Vina\View;


trait _HasAttributes
{
	public $_attributes = [];

	public $styleClasses = [];

	private $_inlineStyleParamBag ;



	protected function attributes()
	{
		$html = '';

		if(!empty($this->styleClasses))
		{
			$this->setAttribute( 'class', implode( ' ', $this->styleClasses ) );
		}

		if( !$this->inlineStyleParamBag()->isEmpty() )
		{
			$this->setAttribute( 'style', $this->inlineStyleParamBag()->compile() );
		}

		foreach ( $this->attributeMap() as $key => $value)
		{
			$html .= ' '.$key.'="'.$value.'"';
		}

		return $html;
	}

	public function attribute( $key )
	{
		if(isset( $this->attributeMap()[$key] ))
		{
			return $this->attributeMap()[$key];
		}
	}

	public function hasAttribute( $key )
	{
		return array_key_exists( $key, $this->attributeMap() );
	}

	final public function attributeMap()
	{
		return array_merge( $this->_attributes, $this->customAttributes() );
	}

	public function setAttribute( $key, $value )
	{
		if( $key == 'class' )
		{
			$this->addStyleClass($value);
		}
		if( $key == 'style' )
		{
			throw new \Exception("Error Processing Request", 1);
		}
		else
		{
			$this->_attributes[$key] = $value;
		}

		return $this ;
	}

	public function setAttributes( $atts )
	{
		foreach ($atts as $key => $value)
		{
			$this->setAttribute($key, $value);
		}

		return $this ;
	}

	public function setURL( $url )
	{
		$this->setAttribute('href', $url );
		return $this;
	}

	public function hasURL()
	{
		return $this->hasAttribute('href') ;
	}

	public function customAttributes()
	{
		return [] ;
	}

	public function addStyleClass( $selectorKey )
	{
		if( is_array($selectorKey) )
		{
			foreach ($selectorKey as $key)
			{
				$this->addStyleClass($key);
			}
		}
		else
		{
			$this->styleClasses[$selectorKey] = $selectorKey;
		}

		return $this ;
	}

	final public function _inlineStyleSet( $key, $value = '' )
	{
		if( is_array($key) )
		{
			foreach ($key as $k => $v)
			{
				$this->_inlineStyleSet($k, $v);
			}

			return $this ;
		}

	 	$this->inlineStyleParamBag()->set($key, $value);

		return $this ;
	}

	final public function _inlineStyleSetUnit( $key, $value = '' )
	{
		if( is_array($key) )
		{
			foreach ($key as $k => $v)
			{
				$this->_inlineStyleSetUnit($k, $v);
			}

			return $this ;
		}

	 	$this->inlineStyleParamBag()->setUnit($key, $value);

		return $this ;
	}

	public function inlineStyleParamBag()
	{
		if( empty($this->_inlineStyleParamBag) )
		{
			$this->_inlineStyleParamBag = new Style\Param\_Bag;
		}

		return $this->_inlineStyleParamBag ;
	}
}
