<?php namespace app\ui\component\article;

class CreateTimeAndAuthor extends \Jhul\Core\UI\Element\Composite
{

	public function __construct( $name )
	{
		parent::__construct($name);

		$this->add($this->name().'left')->grow()->alignItemsRight()->centerY()->setWidth('48.5%');
		$this->add($this->name().'center', '|')->center()->setFontBold()->setColor('yellow')->setWidth('1%')->setPaddingH(12);
		$this->add($name.'right')->grow()->centerY()->setWidth('48.5%');



		$this->_left()->add('ctaaan', '<?= $mData->item()->author()->name() ?>' )->setFontSize(14)->setFontBold()->setURL('<?= $mData->item()->author()->url() ?>');
		$this->_right()->add('ctaalt', '<?= $this->mTime()->toDate( $mData->item()->createdOnTime() ); ?>' )->setFontSize(12)->setFontBold();


		$this->setPaddingV(24);


	}


	public function _left()
	{
		return $this->child( $this->name().'left' ) ;
	}

	public function _right()
	{
		return $this->child( $this->name().'right' ) ;
	}

	public function byLabel()
	{
		return 'सम्पादित :' ;
	}

	public function createdOnLabel()
	{
		return 'दिनांक' ;
	}

}
