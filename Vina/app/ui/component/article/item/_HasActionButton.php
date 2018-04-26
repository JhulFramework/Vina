<?php namespace app\ui\component\article\item;

trait  _HasActionButton
{
	private $_actionbar;

	abstract public function actionButtonName();
	abstract public function actionButtonURL();
	abstract public function actionButtonText();
	abstract public function actionButtonIcon();

	public function hasActionButton(){ return TRUE ; }

	public function actionbar()
	{
		$actionbar = new \app\ui\component\article\Actionbar('actionbar');
		$actionbar->createButton( $this->actionButtonName() )

		->setText( $this->actionButtonText() )
		->setIcon( $this->actionButtonIcon() )
		->setURL( $this->actionButtonURL() );
		return $actionbar ;
	}
}
