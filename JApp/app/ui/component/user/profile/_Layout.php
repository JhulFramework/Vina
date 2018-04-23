<?php namespace app\ui\component\user\profile;

class _Layout extends \Jhul\Core\UI\Element\Composite
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->addStyle( 'hideHeader', $this->superLayout()->header()->style()->hiddenStyle() );

		$this->growWidth();
		$this->growHeight();
		$imagec = new ImageContainer( 'profilPictureContainer' );


		$this->add($imagec);
		$this->add( new Cover('pp_cover') );
		$this->add( new UserInfoContainer('userinfo_container') );

		$this->addStyle('hidefooter', $this->superLayout()->footer()->style()->hiddenStyle());

		$this->onMaxScreenWidth(720)->_styleSet('text-shadow',  '0px 0px 6px #000000');


	}

	public function profilePicture()
	{
		return $this->child( $this->name().'profilPictureContainer' );
	}
}
