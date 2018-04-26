<?php namespace app\ui\component\chat\roomlist;

class _Layout extends \Jhul\Core\UI\View\Layout
{
	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function template()
	{
		return 'layout' ;
	}

	public function styleResources()
	{
		return [ 'dimension', 'r2c', 'color', 'rules' ] ;
	}

	public function fragmentResources()
	{
		return
		[
			'rules',
		] ;
	}
}
