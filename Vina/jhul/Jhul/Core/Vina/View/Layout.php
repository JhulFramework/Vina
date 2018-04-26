<?php namespace Jhul\Core\Vina\View;


abstract class Layout extends _Class
{

	use _Composite;
	use _HasVariable;
	use _HasResource;
	use _HasTemplate;

	public function __construct( $name )
	{
		parent::__construct($name);

		$this->_initComposite();
		$this->_initHasTemplate();
	}

	public function ifBindContent(){ return FALSE ; }

	public function compileStyle()
	{
		return $this->j()->ui()->injectParams
		(
			parent::compileStyle().$this->loadStyleResources(),
			$this->styleVariables()
		);
	}

	public function compileScript()
	{
		return $this->j()->ui()->injectParams
		(
			parent::compileScript().$this->loadScriptResources(),
			$this->scriptVariables()
		);
	}



	public function beforeCompile()
	{
		$this->compileComposite();
		$this->compileTemplate();
		parent::beforeCompile();
	}

	public function compileContent()
	{
		return $this->viewBag()->compiledContent().$this->compiledTemplate() ;
	}

	//add child
	protected function objectifyChild( $name, $content )
	{
		return new Element( $name, $content) ;
	}

}
