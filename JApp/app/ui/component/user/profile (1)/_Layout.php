<?php namespace app\ui\component\user\profile;

class _Layout extends \Jhul\Core\UI\_Design\_Layout
{
	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function useStyles()
	{
		return [ 'r2c', 'typo', 'social', 'color' ] ;
	}

	public function layout()
	{
		return 'body'  ;
	}

	public function beforeCompile()
	{
		$this->setFragment('tagline', new \app\ui\component\user\tagline\Layout('tagline_view') );
	}
}
