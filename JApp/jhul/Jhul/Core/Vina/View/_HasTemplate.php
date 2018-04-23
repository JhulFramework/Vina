<?php namespace Jhul\Core\Vina\View;


/*
+=======================================================================================================================
| Template fragmemt can be string, They must not all be view objects, since it containes html head, meta fargments
| if overriden aLways call parent::_compiledChildren();
+---------------------------------------------------------------------------------------------------------------------*/

trait _HasTemplate
{

	private $_fragmentViewBag;
	private $_appendViewBag;

	protected function _initHasTemplate()
	{
		$this->_fragmentViewBag	= new Bag\Fragment($this);
		$this->_appendViewBag	= (new Bag\Sequence($this))->setName('append');
	}

	abstract public function template();

	public function fragmentBag()
	{
		return $this->_fragmentViewBag;
	}

	public function fragment( $name )
	{
		return $this->_fragmentViewBag->get($name);
	}

	public function fragmentResources()
	{
		return [] ;
	}

	public function compileFragmentResources()
	{
		foreach ( $this->fragmentResources() as $k => $r)
		{
			if( ctype_alpha($k) )
			{
				$this->setFragment( $k, $this->_loadFile($r, 'php') );
			}

			$this->setFragment( $r, $this->_loadLocalFile($r, 'php') );
		}
	}

	final public function compileTemplate()
	{
		if( NULL != $this->template() )
		{

			$this->compileFragmentResources();
			$this->_fragmentViewBag->compile();

		}

		$this->_appendViewBag->compile();
	}

	final public function compiledTemplate()
	{
		if( NULL == $this->template() ) return $this->_appendViewBag->compiledContent() ;


		return $this->j()->ui()->compileContent( $this->resDirPath().'/'.$this->template(), $this->_fragmentViewBag->compiled() ).$this->_appendViewBag->compiledContent() ;
	}


	public function loadFragmentResource( $name, $resFile )
	{
		$this->setFragment( $name, $this->_loadFile($resFile.'.php') );
	}

	//add child
	final public function setFragment( $child, $content = '' )
	{
		return $this->_fragmentViewBag->add( $child, $content );
	}


	public function hasFragment($name)
	{
		return $this->_fragmentViewBag->has($name);
	}

}
