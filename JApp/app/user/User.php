<?php namespace app\user;

class User extends \Jhul\Core\Application\User\_Class
{



	public function avatar()
	{
		return $this->getState('avatar') ;
	}

	public function sessionStoreKey()
	{
		return 'user';
	}

	public function keyName()
	{
		return 'user_key';
	}

	public function iname()
	{
		return $this->getState('iname');
	}

	public function name()
	{
		return $this->getState('name');
	}

	public function url()
	{
		return $this->app()->url().'/@'.$this->iname();
	}

	public function tagline()
	{
		return $this->getState('tagline');
	}


	public function DAOClass()
	{
		return '\\_m\\user\\context\\siu_\\dao\\User';
	}


	protected function saveLoginData( $user )
	{
		$this->setState( 'name', $user->name() );
		$this->setState( 'iname', $user->iname() );
		$this->setState( 'avatar', $user->avatar() );
		$this->setState( 'language', $user->language() );
		$this->setState( 'gender', $user->gender() );
		$this->setState( 'tagline', $user->tagline() );
	}

	public function setAvatar( $url )
	{
		$this->setState( 'avatar', $url );

	}

	public function isAdmin()
	{
		return FALSE ;
	}
}
