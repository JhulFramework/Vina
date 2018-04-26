<?php namespace Jhul\Core\Vina\View;



class Element extends  _Class
{
	private $_content;

	public function __construct( $name, $content = 'Content Not Set' )
	{
		parent::__construct($name);

		if( is_object($content) )
		{
			$content->_setName($name);
		}

		$this->setContent( $name.'_'.$content );
		$this->setDisplayFlex();

	}

	public function ifBindContent()
	{
		return TRUE ;
	}

	public function setContent( $content )
	{
		$this->_content = $content;

		return $this ;
	}

	//always compile children in beforeCompile;
	public function beforeCompile()
	{
		if( is_object($this->_content) )
		{
			$this->_compileSubView($this->_content) ;
		}
	}

	protected function compileContent()
	{
		return is_object($this->_content)  ? $this->_content->compiledContent() : $this->_content ;
	}


}
