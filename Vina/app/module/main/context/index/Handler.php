<?php namespace _modules\main\nodes\index;

class Handler extends \Jhul\Core\Application\Handler\_Class
{
	public function switchTo()
	{

		if( !$this->getApp()->user()->isAnon() )
		{
			return 'user#siu';
		}

		return 'user#anon';
	}
}
