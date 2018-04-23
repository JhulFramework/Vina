<?php namespace app\ui\component\user\profile;

class ImageContainer extends \Jhul\Core\UI\Element\Composite
{
	public function __construct( $name )
	{
		parent::__construct($name);

		$this->growHeight();
		$this->setContent('');
		$this->center();
		$this->setWidth('50%');
		$this->setHeight('100%');

		$this->style()->onMaxScreenWidth(720)
		->setPositionAbsolute()
		->setZIndex(3)
		->_styleSet('transform','translateX(-50%)')
		->growWidth()
		->setWidth('100%');
		$this->setAttribute( 'style', 'background-image : url(\'<?= $host->avatar() ?>\');' );

		$this->_styleSet
		([
			'background-repeat' => 'no-repeat',
			'background-position' => 'center',

			'background-size' =>  'contain',
		]);
	}
}
