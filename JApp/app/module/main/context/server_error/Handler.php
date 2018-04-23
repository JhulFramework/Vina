<?php namespace _modules\main\nodes\server_error;


class Handler extends \Jhul\Core\Application\Node\Handler\_Class
{
	public function handle()
	{
		$this->getApp()->page()->addContent( '<div class="VPad12" > Some Error Occured </div>' );
	}
}
