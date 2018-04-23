<?php namespace app\ui\component\article\index;

abstract class _Class extends \Jhul\Core\UI\_Design\_Layout
{

	private $_panel;

	public function __construct( $params = [] )
	{
		$this->addScript( 'voteURL', 'var voteURL = \''. $this->voteURL() .'\'  ;' ) ;

		$this->_panel = new \app\ui\component\article\panel\Panel( 'article_panel');

		$this->_panel->enableVoteButton();
		$this->_panel->enableReadButton();


		parent::__construct( $params );
	}

	public function actionbar(){}

	public function useStyles()
	{
		return [ 'layout', 'color', 'removeButtonPressEffect' ] ;
	}

	public function layout()
	{
		return 'body' ;
	}

	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function beforeCompile()
	{
		if( $this->ifMember() )
		{
			$this->_panel->setIfMember(TRUE);
		}

		$this->setFragment( 'articlePanelView', $this->_panel );
		$this->setFragment( 'articleIndexActionbar', $this->actionbar() );
	}

	abstract public function voteUrl();

	abstract public function ifMember();

}
