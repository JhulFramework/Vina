<?php namespace Jhul\Core\UI\Layout\Index\VIndex;

class Layout extends \Jhul\Core\UI\View\Layout
{

	private $_items = [];

	public function setItems( $items )
	{
		$this->_items = $items;
		return $this ;
	}

	public function styleResources()
	{
		return [ 'layout' ] ;
	}

	public function resDirPath()
	{
		return __DIR__.'/res' ;
	}

	public function compileContent()
	{
		$html = '';

		foreach ( $this->_items as $key => $item )
		{
			$html .= $this->j()->ui()->renderView( $this->resDirPath().'/item.php', [ 'p' => $item ] );
		}

		return '<div class="_main_menu_index" >'.$html.'</div>' ;
	}

	public function template()
	{

	}
}
