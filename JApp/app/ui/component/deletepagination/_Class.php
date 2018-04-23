<?php namespace app\ui\component\pagination;

abstract class _Class extends \Jhul\Core\UI\_Design\_Layout
{
	public function __construct(  )
	{
		//parent::__construct($name);

		$this->setFragment( 'previous_button_content', $this->previousButtonContent() );

		$this->setFragment( 'next_button_content', $this->nextButtonContent() );

	}

	public function useStyles()
	{
		return [ 'style' ] ;
	}

	public function layout()
	{
		return 'body' ;
	}

	abstract public function previousButtonContent();

	abstract public function nextButtonContent();

	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}
}
