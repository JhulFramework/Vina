<?php namespace Jhul\Core\Vina\View;

abstract class _Class implements _Interface
{

	use \Jhul\Core\_AccessKey;

	use _HasAttributes;
	use Style\_HasStyle;

	private $_compiledScript;

	private $_compiledContent;

	private $_name;

	private $_parentKey;

	private $_scripts = [];


	public function __construct( $name )
	{
		$this->_name = $name;

		$this->_initHasStyle();
	}

	public function setParentKey( $name )
	{
		$this->_parentKey = $name;
		return $this ;
	}

	final public function compiledContent()
	{
		if( $this->ifBindContent() )
		{
			return $this->_wrapContent( $this->_compiledContent );
		}

		return $this->_compiledContent;
	}

	public function htmlEncode( $string )
	{
		return htmlspecialchars( $string, ENT_QUOTES, 'utf-8' );
	}

	public function show()
	{
		return htmlspecialchars( $this->embed(), ENT_QUOTES, 'utf-8' );
	}

	public function showContent()
	{
		return htmlspecialchars( $this->compiledContent(), ENT_QUOTES, 'utf-8' );
	}

	public function scriptAsHTML()
	{
		if( strlen($this->script()) > 10 )
		{
			return '<script>'.$this->compiledScript().'</script>' ;
		}
	}

	public function embed()
	{
		return $this->style()->embed().$this->compiledContent().$this->scriptAsHTML();
	}

	public function compiledScript()
	{
		return $this->_compiledScript;
	}

	public function script()
	{
		return $this->_compiledScript;
	}

	public function name()
	{
		return $this->_name;
	}

	final public function _key()
	{
		if( !empty($this->_parentKey) )
		{
			return $this->_parentKey.'_'.$this->name() ;
		}

		return $this->name() ;
	}

	public final function _setName( $name )
	{
		$this->_name = $name;
		return $this ;
	}

	public function compileStyle()
	{
		return $this->style()->compile() ;
	}

	public function compileScript()
	{
		if( !empty($this->_scripts) )
		{
			return  implode( ' ', $this->_scripts );
		}
	}

	final public function compile()
	{
		$this->beforeCompile();
		$this->style()->setCompiled( $this->compileStyle() );
		$this->_setCompiledScript( $this->compileScript());

		$this->beforeCompileContent();
		$this->_setCompiledContent( $this->compileContent() );
	}

	final public function _setCompiledContent( $content )
	{
		$this->_compiledContent = $content;
		return $this ;
	}

	final private function _setCompiledStyle( $style )
	{
		$this->_compiledStyle = $style;

		return $this ;
	}

	final public function _setCompiledScript( $script )
	{
		$this->_compiledScript = $script;

		return $this ;
	}

	public function hasScript()
	{
		return !empty($this->_compiledScript) ;
	}

	public function beforeCompile(){}
	public function beforeCompileContent(){}

	public final function _mui()
	{
		return \Jhul::I()->ui() ;
	}

	public function superLayout()
	{
		return \Jhul::I()->ui()->superlayout() ;
	}

	final public function addScript( $key, $value )
	{
		$this->_scripts[$key] = $value;
		return $this;
	}

	public function generateStyleSelectorKey()
	{
		return $this->_mUI()->getStyleSelector($this->_key());
	}

	abstract public function ifBindContent();


	final public function _compileSubView( $view )
	{
		$view->compile();
		$this->addStyle( $view->name(),  $view->compiledStyle() );
		$this->addScript( $view->name(),  $view->compiledScript() );
		return $view->compiledContent() ;
	}
}
