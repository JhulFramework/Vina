<?php namespace Jhul\Core\UI\Helper;

class Hex2RGBA
{


	public static function convert($color, $opacity = 1)
	{
		$color = (string) $color;

		if (strlen($color) == 6)
		{
			$hex = [ $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] ];
		}
		else
		{
			$hex = [ $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] ];
		}

		$param =  array_map('hexdec', $hex);

		$param[] = $opacity;

		return 'rgba('.implode(',',$param).')';
	}
}
