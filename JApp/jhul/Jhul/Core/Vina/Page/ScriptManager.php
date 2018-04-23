<?php namespace Jhul\Core\Application\Page;


/* @Author : Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Created : Wed 06 Apr 2016 01:59:09 PM IST
| Script Manager
+---------------------------------------------------------------------------------------------------------------------*/

class ScriptManager extends _ResourceManager
{


	public function fileExtension() { return 'js' ; }
	public function fileBasename() { return 'script' ; }

	public function wrapLink( $url )
	{
		return '<script src="'.$url.'.js"></script>' ;
	}
}
