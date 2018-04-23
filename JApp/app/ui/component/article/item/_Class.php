<?php namespace app\ui\component\article\item;


abstract class _Class extends \Jhul\Core\UI\_Design\_Layout
{

	private $_panel ;

	public function ifBindContent()
	{
		return TRUE ;
	}

	public function __construct(  $params = [] )
	{
		$this->addScript( 'voteURL', 'var voteURL = \''. $this->voteURL() .'\'  ;' ) ;

		parent::__construct( $params );

		$this->setFragment('articleTitleView', (new \Jhul\Core\UI\Element\TextView('atl', '<?= $mData->item()->title() ?>' ))->setFontSize(24)->setPaddingV('1%')  );

		$this->setFragment('articleEditOn', (new \app\ui\component\article\EditedOnTime('aeov')) );
		$this->setFragment('articleCreatedTimeAndAuthor', new \app\ui\component\article\CreateTimeAndAuthor('actaa') );


		$this->setFragment('articleContentView', (new \Jhul\Core\UI\Element\TextView('acl', '<?= $mData->item()->content() ?>' ))->setPreFormatted(TRUE)  );

		$this->_panel = new \app\ui\component\article\panel\Panel( 'artcile_panel');

		$this->_panel->enableVoteButton();

		$this->setPaddingH('3%');
	}


	public function layout()
	{
		return 'body' ;
	}

	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	abstract public function voteUrl();

	abstract public function ifMember();

	public function actionbar(){}

	public function beforeCompile()
	{
		$this->_panel->setIfMember( $this->ifMember() );

		$this->setFragment( 'articlePanelView', $this->_panel );

		$this->setFragment('itemActionbar', $this->actionbar());
	}

}
