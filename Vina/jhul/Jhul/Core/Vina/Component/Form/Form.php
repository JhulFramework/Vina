<?php namespace Jhul\Core\UI\Component\Form;

abstract class Form extends \Jhul\Core\UI\View\Element\Composite
{

	private $_title ;

	private $_description ;

	//child view objects
	private $_fieldViewObjects = [];

	private $_autoAddButton = TRUE;

	private $_button;
	private $_tokenField;

	private $_theme;

	private $_viewTypeMap =
	[
		'editText' 		=> __NAMESPACE__.'\\Field\\EditText',
		'password' 		=> __NAMESPACE__.'\\Field\\Password',
		'editTextBig' 	=> __NAMESPACE__.'\\Field\\EditTextBig',
		'token' 		=> __NAMESPACE__.'\\Field\\Token',
		'selectOne' 	=> __NAMESPACE__.'\\Field\\SelectOne',
		'button' 		=> 'Jhul\\Core\\UI\\Component\\Button',
	];

	private $_fieldSection;

	public function fieldSection()
	{
		return $this->_fieldSection ;
	}

	public function dm()
	{
		return $this->context()->form() ;
	}

	public function __construct( $name = '' )
	{
		parent::__construct($name);
		$this->setAttribute( 'method', 'post' );
		$this->setAttribute( 'action', '' );
		$this->_viewTypeMap = array_merge( $this->_viewTypeMap, $this->useViewTypeMap() );

		$this->setPaddingH('6%');

		$this->_fieldSection = $this->createSimpleView('fieldSection');
		$this->_fieldSection
		->setDisplayFlex()
		->setPaddingV(24)

	//	->setBackground('blue')
		->setFlexDirectionColumn();

		$this->_theme = new Theme($this);
	}

	public function theme()
	{
		return $this->_theme  ;
	}

	public function ifBindContent()
	{
		return TRUE ;
	}

	public function viewTypeMap()
	{
		return $this->_viewTypeMap ;
	}

	public function mField()
	{
		return $this->dm()->mField();
	}

	public function name()
	{
		return $this->dm()->name() ;
	}

	public function setAutoAddButton( $bool )
	{
		$this->_autoAddButton = $bool;
		return $this ;
	}

	public function compileFields()
	{
		$fields = '';

		foreach ( $this->_fieldViewObjects  as $k => $f)
		{

			$f = $this->theme()->applyStyleToField($f);

			$fields .= $this->_compileSubView($f);
		}
		return $fields;
	}

	private function loadDefaultFields()
	{
		foreach ( $this->mField()->keys() as $field )
		{
			if( !isset($this->_fieldViewObjects[$field]) && $this->mField()->has($field, 'view_type') )
			{
				$viewType = $this->mField()->get($field, 'view_type');

				if( strrpos( $viewType, '\\' ) )
				{
					$this->addField( $field,  $this->createField( new $viewType($field) ) );
				}
				else
				{
					$this->addFieldByKey( $field, $viewType );
				}
			}
		}
	}

	public function beforeCompile()
	{
		$this->loadDefaultFields();

		if( empty($this->_button) && $this->_autoAddButton ) $this->createDefaultButton();

		$this->compileFormElements();

		parent::beforeCompile();
	}

	public function compileFormElements()
	{
		$this->loadDefaultFields();

		$this->fieldSection()->setContent($this->compileFields());
		$this->_compileSubView($this->fieldSection());

		if(!empty($this->_tokenField))
		{
			$this->_compileSubView($this->_tokenField);
		}

		if( !empty($this->_button))
		{
			$this->_compileSubView($this->_button);
		}

		if( !empty($this->_description) || NULL != $this->descriptionText() )
		{
			$this->_compileSubView($this->description());
		}

		if( !empty($this->_title) || NULL != $this->titleText() )
		{
			$this->_compileSubView($this->title());
		}
	}

	public function compileContent()
	{
		$content = $this->fieldSection()->compiledContent().$this->_tokenField->compiledContent().$this->_button->compiledContent()  ;

		if( !empty($this->_description) || NULL != $this->descriptionText() )
		{
			$content = $this->description()->compiledContent().$content ;
		}

		if( !empty($this->_title) || NULL != $this->titleText() )
		{
			$content = $this->title()->compiledContent().$content ;
		}

		return $content ;
	}

	public function wrapContent( $content )
	{
		return '<form '.$this->attributes().' >'.$content.'</form>' ;
	}

	final public function title()
	{
		if( empty($this->_title)  )
		{
			$this->setTitle($this->titleText());
		}

		return $this->_title ;
	}

	public function titleText(){}

	final public function description()
	{
		if( empty($this->_description)  )
		{
			$this->setDescription($this->descriptionText());
		}
		return $this->_description ;
	}

	public function descriptionText(){}


	public function enableFileUpload()
	{
		return $this->setAttribute( 'enctype', 'multipart/form-data' );
	}

	public function setTitle( $title )
	{
		if(is_string($title))
		{
			$title = $this->createSimpleView('title', $title);
			$title->setFontSize(24)->_styleSetUnit('padding-bottom', 12);
		}
		$this->_title = $title ;
		return $this ;
	}

	public function setDescription( $description )
	{
		if(is_string($description))
		{
			$description = $this->createSimpleView('description', $description);
		}
		$this->_description = $description ;
		return $this ;
	}

	public function createSimpleView( $name, $content = '' )
	{
		return  $this->_mui()->createView( 'element', $name )->setContent($content) ;
	}


	private $_loadParams = [ 'label', 'id' ];

	private $_fields = [] ;

	/*
	| add fields and immediatly serializes it
	| @param $key  = field key
	| @param $object  = field view object
	*/
	public function addField( $key, $view )
	{
		$view->setParentKey( $this->_key() );

		if( $view instanceOf Field )
		{
			if( $view->input()->attribute('type') == 'file' )
			{
				$this->enableFileUpload();
			}

			if( $this->mField()->has( $key, 'id' ) )
			{
				$view->setId(  $this->mField()->get($key, 'id') );
			}

			if( $this->mField()->has( $key, 'label' ) )
			{
				$view->setLabel(  $this->mField()->get($key, 'label') );
			}
		}

		$this->_fieldViewObjects[ $key ] = $view;

		return $this;
	}

	public function setTokenField( $key = '_token' )
	{
		$class = $this->viewTypeMap()['token'];

		$this->_tokenField = (new $class($key))->setForm( $this );

		return $this;
	}

	public function createDefaultButton()
	{
		$class = $this->viewTypeMap()['button'];

		$this->_button = new $class( 'button' );

		$this->_button->set('content', 'SAVE');
	}

	public function setButton( $button )
	{
		$this->_button = $button;
		return $this;
	}

	public function createField( $inputView )
	{
		return  ( new Field( $inputView ))->setForm($this );
	}

	public function addFieldByKey( $key, $type = '' )
	{
		if( isset($this->viewTypeMap()[$type]) )
		{
			$class = $this->viewTypeMap()[$type];

			$input = new $class($key);

			$this->addField( $key, $this->createField( $input ) );
		}
		else
		{
			throw new \Exception( 'field type "'.$type.'" Not defined for "'.$key.'" ! use addField( \''.$key.'\' , new YourFieldClass() ) or add it in []useViewTypeMap() ' , 1);
		}

	}

	public function useViewTypeMap() { return [] ; }

	public function variableName()
	{
		return $this->name().'Form' ;
	}
}
