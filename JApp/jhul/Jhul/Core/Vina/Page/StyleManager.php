<?php namespace Jhul\Core\Application\Page;

/* @AUTHOR Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Created : 09-Nov-2015 10:37:26 AM IST
| Style Manager
+---------------------------------------------------------------------------------------------------------------------*/

class StyleManager extends _ResourceManager
{
	public function fileExtension() { return 'css' ; }

	public function fileBaseName() { return 'style' ; }
}
