<?php namespace Jhul\Core\UI\SuperLayout;

trait _SEOTag
{

	private $_meta;

	final public function _mMeta()
	{
		if( empty($this->_mMeta) )
		{
			$this->_mMeta = new Meta();
		}

		return $this->_mMeta ;
	}

	public function metaTags()
	{
		return $this->_compileSEOTag();
	}

	private function _compileSEOTag()
	{
		$this->_mMeta()->add('title', $this->SEOTagTitle());
		$this->_mMeta()->add('description', $this->SEOTagDescription());
		$this->_mMeta()->add( 'twitter:card', 'summary' );
		$this->_mMeta()->addOGTag( 'og:description', $this->SEOTagDescription() );
		$this->_mMeta()->addOGTag( 'og:title', $this->SEOTagTitle() );

		return $this->_mMeta()->compile();
	}

	public abstract function SEOTagDescription();
	public abstract function SEOTagTitle();
}
