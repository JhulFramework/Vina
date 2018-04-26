<?php namespace Jhul\Core\Vina\View\Style;


class Manager extends _Composer
{
	use _Key ;

	use _HasMediaQuery;

	private $_compiled = '';

	private $_styles = [];

	private $_childTagStyles = [];

	private $_onHover;

	public function setCompiled( $compiled )
	{
		$this->_compiled = $compiled;
	}

	public function map()
	{
		return $this->_styles ;
	}

	public function isEmpty()
	{
		return empty($this->_compiled) && empty($this->_styles) ;
	}

	public function compiled()
	{
		return $this->_compiled ;
	}

	public function add( $key, $value )
	{
		$this->_styles[$key] = $value;
	}

	public function compile()
	{
		$style = $this->compileStyle();

		if( !empty($this->_styles) )
		{
			$style .= implode(' ', $this->_styles);
		}

		$style .= $this->compileHoverStyle();

		$style .= $this->compileChildTagStyles();

		$style .= $this->compileMediaQueries();

		return $style ;
	}

	public function compileChildTagStyles()
	{
		$style = '';

		foreach ( $this->_childTagStyles  as $key => $child)
		{
			$child->setParentStyleSelector( $this->selector() );

			$style .= $child->compile();
		}

		return $style ;
	}


	public function embed()
	{
		if( !$this->isEmpty() )
		{
			return '<style>'.$this->compiled().'</style>' ;
		}
	}

	public function childTagStyle( $tag )
	{
		if( !isset($this->_childTagStyles[$tag]) )
		{
			$this->_childTagStyles[$tag] = new ChildTagStyle( $tag );
		}

		return $this->_childTagStyles[$tag] ;
	}

	public function onHover()
	{
		if( empty($this->_onHover) )
		{
			$this->_onHover = new OnHover($this) ;
		}

		return $this->_onHover ;
	}

	public function compileHoverStyle()
	{
		if( !empty($this->_onHover) ) return $this->_onHover->compile() ;
	}

	final public function hiddenStyle()
	{
		return $this->selector().'{display:none;}';
	}
}
