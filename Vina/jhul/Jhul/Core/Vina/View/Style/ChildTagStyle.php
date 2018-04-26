<?php namespace Jhul\Core\Vina\View\Style;

/*
| Has tag name and parent slector
*/

class ChildTagStyle extends _Composer
{

	use _API;

	use _MediaQuery;

	public function __construct( $tag )
	{
		parent::__construct();
		$this->setName( $tag );
	}

	public function isTag()
	{
		return TRUE ;
	}

	public function compile()
	{
		$style = $this->compileStyle();

		$style .= $this->compileMediaQueries();

		return $style ;
	}

}
