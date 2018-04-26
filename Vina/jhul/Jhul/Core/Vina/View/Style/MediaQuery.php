<?php namespace Jhul\Core\Vina\View\Style;


class MediaQuery extends _Composer
{
	use Param\_API;



	private $_type;
	private $_size;

	public function __construct( $viewObject, $type, $size )
	{
		parent::__construct($viewObject);

		$this->_type = $type;
		$this->_size = $size;
	}

	public function compileMediaQuery()
	{
		return '@media only screen and ('.$this->_type.'-width: '.$this->_size.'px){'.$this->compileStyle().'}';
	}

	public function compile()
	{
		return $this->compileMediaQuery() ;
	}

	public function selector()
	{
		return $this->viewObject()->style()->selector();
	}

}
