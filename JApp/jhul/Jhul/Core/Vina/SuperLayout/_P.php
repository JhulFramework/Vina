<?php namespace Jhul\Core\UI\SuperLayout;

class _P
{

	use \Jhul\Core\Access\Key;
	use \Jhul\Core\Containers\_Config;

	public function __construct()
	{
		$path = $this->j()->fx()->dirPath(get_called_class());

		$this->config()->add( $this->j()->fx()->readConfigFile( $path.'/_config' ) );
	}

	public function fontFamily()
	{
		return $this->config('fontFamily') ;
	}
}
