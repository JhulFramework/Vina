<?php namespace app\ui\component\article;

class EditedOnTime extends \Jhul\Core\UI\Element\Composite
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->add('eotmlb', $this->editedOnLabel() )->setFontSize(12);

		$this->add('eots', ':' )->setPaddingH(6)->setFontSize(12)->setFontBold();

		$this->add('eotm', '<?= $this->mTime()->toDate( $mData->item()->editedOnTime() ); ?>' )->setFontSize(12)->setFontBold();

		$this->setPadding(12);
	}


	public function editedOnLabel()
	{
		return 'सम्पादित' ;
	}

}
