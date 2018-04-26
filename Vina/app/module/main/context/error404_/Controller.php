<?php namespace _m\main\context\error404_;

class Controller extends \Jhul\Core\Application\Controller\_Class
{
	public function makeWebPage()
	{
		//$this->ifRefreshWebPage = TRUE;

		$this->statusCode = 404;

		$this->setTitle( 'PAGE NOT FOUND' );
	}

	public function makeJSON()
	{
		$this->set( 'message', 'invalid_request' );
	}
}
