<?php namespace app\ui\component\user\profile;

class UserInfoContent extends \Jhul\Core\UI\_Design\_Layout
{
	public function layout()
	{
		return 'body' ;
	}

	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function useStyles()
	{
		return ['layout', 'color'] ;
	}

	public function beforeCompile()
	{
		$name = new Name('name');
	//	$name->setParentStyleClass('userinfo');

//		$name->compile();

		$this->setFragment('name', $name);

		$tagline = new Tagline('tagline');
		//$tagline->setParentStyleClass('userinfo');

		$this->setFragment('tagline', $tagline);


		$this->setFragment('homeIcon', new HomeIcon('homeIcon'));
	}
}
