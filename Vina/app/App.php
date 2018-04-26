<?php namespace app;

class App extends \Jhul\Core\Application\Application
{
	protected function beforeRun()
	{
		//$this->_su = new SU( $this->url() );
		$this->lipi()->setCurrentLanguage( $this->user()->language() );
	}

	protected function resolveOutputMode()
	{
		if( isset( $_GET['mode'] ) && $_GET['mode'] == 'json' )
		{
			return 'json' ;
		}
	}

	public function apiVersion()
	{
		if( isset( $_GET['api_version'] ) )
		{
			$v = (int) $_GET['api_version'];

			if( $v == 2 ) return 2;
		}
		return 1 ;
	}
}
