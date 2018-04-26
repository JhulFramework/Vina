<?php namespace app\ui\component\user\profile;

class MSocialIcon extends \Jhul\Core\UI\Element\Composite
{

	private $_dao ;

	public function __construct( $item )
	{
		$this->_item = $item;
	}

	public function setDAO( $dao )
	{
		$this->_dao = $dao;
	}

	public $_URLMap =
	[

		'github' 	=> 'https://github.com/',
		'instagram' => 'https://instagram.com/',
		'facebook'	=> 'https://facebook.com/',
		'pinterest'	=> 'https://pinterest.com/',
		'gplus'	=> 'https://google.com/+',
	];


	public function toHTML()
	{
		$html = '';

		foreach (  $this->_item->fields() as $field)
		{
			$html .= $this->makeURL( $field );
		}

		return $html ;
	}


	public function makeURL( $field )
	{
		if( !$this->_item->ifEmpty( $field ) )
		{
			$url = isset($this->_URLMap[$field]) ? $this->_URLMap[$field].$this->_item->read($field) : $this->_item->read($field)  ;

			return '<a class="'.$field.'" href="'.$url.'"><i class="icon-'.$field.'"></i></a>' ;
		}
	}
}
