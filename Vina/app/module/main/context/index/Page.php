<?php namespace _modules\main\nodes\index;

class Page extends \Jhul\Core\Application\Page\_Class
{
	public function makeWebPage()
	{
		return $this->cook('index');
	}
}
