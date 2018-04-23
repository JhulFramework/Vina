<?php namespace app\ui\component\article\panel;

class Panel extends \Jhul\Core\UI\_Design\_Layout
{

	private $_ifEnableVoteButton = FALSE;
	private $_ifEnableReadButton = FALSE;
	private $_ifEnableAuthorLink = FALSE;

	private $_ifMember = FALSE;

	public function ifMember()
	{
		return $this->_ifMember ;
	}

	public function setIfMember( $bool )
	{
		 $this->_ifMember = (TRUE === $bool ) ;
		 return $this ;
	}


	public function enableReadButton()
	{
		$this->_ifEnableReadButton = TRUE;
		return $this ;
	}

	public function enableVoteButton()
	{
		$this->_ifEnableVoteButton = TRUE;
		return $this ;
	}

	public function enableAuthorLink()
	{
		$this->_ifEnableVoteButton = TRUE;
		return $this ;
	}


	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function useStyles()
	{
		return ['layout', 'button_reset', 'color'] ;
	}

	public function useScripts()
	{
		if( $this->ifMember() )
		{
			return ['script'] ;
		}

		return [] ;
	}

	public function layout()
	{
		return 'layout' ;
	}

	public function beforeCompile()
	{
		$content = '';

		if( $this->_ifEnableVoteButton )
		{
			$content .= $this->_voteButtonContent();
		}

		if( $this->_ifEnableReadButton )
		{
			$content .= $this->_readButtonContent();
		}

		if( $this->_ifEnableAuthorLink )
		{
			$content .= $this->_readButtonContent();
		}


		$this->setFragment('article_panel_content', $content );
	}

	private function _voteButtonContent()
	{
		return '
			<div class="left">
			<div class="plus">
				<?= $mButton->plusButton() ?>
			</div>
			<div class="minus">
				<?= $mButton->minusButton() ?>
			</div>
			</div>
			'
			;
	}


	private function _readButtonContent()
	{
		return '<div class="right"><div class="read"><?= $mButton->readButton() ?></div></div>';
	}

	private function _authorLink()
	{
		return '<div class="right"><div class="author"></div></div>';
	}

}
