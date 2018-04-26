<?php namespace app\ui\component\user\tagline;

class Layout extends \Jhul\Core\UI\_Design\_Layout
{
	private $_icon = '<i class="icon-quote" ></i>';

	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function setIcon( $icon )
	{
		$this->_icon = $icon;
		return $this ;
	}

	public function beforeCompile()
	{
		$this->setFragment('icon', $this->_icon);
	}


	public function layout()
	{
		return 'tagline' ;
	}

	public function useStyles()
	{
		return ['tagline'] ;
	}
}
