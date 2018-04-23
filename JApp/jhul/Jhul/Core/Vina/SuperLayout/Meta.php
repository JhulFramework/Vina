<?php namespace Jhul\Core\UI\SuperLayout;

class Meta
{

	private $_tags = [];

	private $_openGraphTags = [];


	private $_ifEnableIndexing = FALSE;

	public function setIfEnableIndexing( $bool )
	{
		$this->_ifEnableIndexing = $bool;

		return $this ;
	}

	public function add( $name, $content )
	{
		$this->_tags[$name] = '<meta name="'.$name.'" content="'.$content.'" /> ';
	}

	public function addHttpEquiv( $httpEquiv, $content )
	{
		$this->_tags[$httpEquiv] = '<meta http-equiv="'.$httpEquiv.'" content="'.$content.'" /> ';
	}

	public function metaTags()
	{
		if( !$this->_ifEnableIndexing )
		{
			$this->add('robots', 'noindex');
		}

		return implode('', $this->_tags) ;
	}

	public function compile()
	{
		return $this->metaTags();
	}

	public function addOGTag( $property , $content )
	{
		$this->_tags[$property] = '<meta property="'.$property.'" content="'.$content.'" /> ';
		return $this ;
	}

}
