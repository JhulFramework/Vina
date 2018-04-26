<?php namespace Jhul\Core\Vina\View\Style;


trait _HasStyle
{
	use Param\_API;

	private $_style;

	public function _initHasStyle()
	{
		$this->_style = new Manager($this);
	}

	final public function style() { return $this->_style; }

	public function setParentStyleSelector( $parentStyleSelector )
	{
		$this->style()->setParentSelector($parentStyleSelector);
		return $this;
	}

	public function childTagStyle( $tag )
	{
		return $this->style()->childTagStyle($tag) ;
	}

	public function onMaxScreenWidth( $unit )
	{
		return $this->style()->onMaxScreenWidth($unit) ;
	}

	public function onMinScreenWidth( $unit )
	{
		return $this->style()->onMinScreenWidth($unit) ;
	}

	public function border()
	{
		return  $this->style()->border();
	}

	public function onHover()
	{
		return  $this->style()->onHover();
	}

	public function shadow()
	{
		return  $this->style()->shadow();
	}

	public function tagKey() { return 'div' ; }

	public function wrapContent( $content )
	{
		return '<'.$this->tagKey().' '.$this->attributes().'>'.$content.'</'.$this->tagKey().'>' ;
	}

	public function compileWrapperStyle()
	{
		return $this->style()->compile() ;
	}

	final public function _wrapContent( $content )
	{
		$this->setAttribute( 'class', $this->style()->selectorKey() );

		if( $this->hasURL() )
		{
			return '<a '.$this->attributes().' >'.$content.'</a>' ;
		}

		return $this->wrapContent($content);
	}

	public function paramBag()
	{
		return $this->style()->paramBag();
	}

	public function addStyle( $key, $value )
	{
		$this->style()->add($key, $value);
		return $this ;
	}

	public function compiledStyle()
	{
		return $this->style()->compiled() ;
	}


}
