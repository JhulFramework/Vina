<?php namespace app\ui\component\sidemenu;

abstract class SideMenu extends \Jhul\Core\UI\_Design\_Component
{

	private $_id = 'jui_sidemenu';

	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function setID( $id )
	{
		$this->_id = $id;
		return $this ;
	}

	public function id()
	{
		return $this->_id ;
	}

	public function setWidth( $width )
	{
		$this->setVariableParam( 'menu_width', $width );
		return $this;
	}

	public function setBackground()
	{

	}

	public function toggleButtonID()
	{
		return $this->id().'_toggle';
	}

	public function openButtonID()
	{
		return $this->id().'_open';
	}

	public function closeButtonID()
	{
		return $this->id().'_close';
	}

	public function openButton( $content = '<i class="icon-menu"></i>' )
	{
		return '<div id="'.$this->openButtonID().'" >'.$content.'</div>' ;
	}

	public function closeButton( $content = '<i class="icon-right"></i> CLOSE' )
	{
		return '<div class="close" id="'.$this->closeButtonID().'" >'.$content.'</div>' ;
	}

	public function toggleButton( $content = '<i class="icon-menu"></i>' )
	{
		return '<div id="'.$this->toggleButtonID().'" >'.$content.'</div>' ;
	}

	public function compileContent()
	{
		return '<div class="'.$this->id().'" id="'.$this->id().'">'.$this->header().$this->compileMenuContent().'</div>';
	}

	public function header()
	{
		return '<div class="header">'.$this->closeButton().'</div>' ;
	}

	public function beforeCompile()
	{

		$this->setVariableParam
		([
			'menu_id'			=> $this->ID(),
			'transition_speed'	=> '0.2',
			'menu_width'		=> '240px',
			'button_toggle_id'	=> $this->toggleButtonID(),
			'button_open_id'		=> $this->openButtonID(),
			'button_close_id'		=> $this->closeButtonID(),
		]);
	}

	public function useScripts()
	{
		return ['script'] ;
	}

	public function useStyles()
	{
		return ['icons', 'menu'] ;
	}

}
