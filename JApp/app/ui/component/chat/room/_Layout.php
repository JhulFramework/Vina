<?php namespace app\ui\component\chat\room;

class _Layout extends \Jhul\Core\UI\_Design\_Layout
{
	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function layout()
	{
		return 'layout' ;
	}

	public function useStyles()
	{
		return [ 'dimension', 'color' ] ;
	}
}
