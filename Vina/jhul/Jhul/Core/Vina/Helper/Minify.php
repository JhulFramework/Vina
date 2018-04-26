<?php namespace Jhul\Core\UI\Helper ;

/*
| MINIFYING HTML is not good
*/

class Minify
{

	public function minifyStyle( $style )
	{
		$style = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $style);
		$style = str_replace(': ', ':', $style);
		return str_replace( ["\r\n", "\r", "\n", "\t", '  ', '    ', '    '], '', $style);
	}
}
