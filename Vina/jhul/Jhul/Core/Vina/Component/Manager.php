<?php namespace Jhul\Core\UI\Component;

class Manager
{
	private $_map =
	[

		'iconLabel' 		=> __NAMESPACE__.'\\IconLabel\\IconLabel',

		'label' 			=> __NAMESPACE__.'\\Label',

		'icon'			=>  'Jhul\\Core\\UI\\View\\Element\\Icon',

		'element'			=>  'Jhul\\Core\\UI\\View\\Element',

		'composite'			=>  'Jhul\\Core\\UI\\View\\Element\\Composite',
	];

	public function create( $componentName, $key )
	{
		if( isset($this->_map[$componentName]) )
		{
			$class = $this->_map[$componentName];
			return new $class($key) ;
		}

		throw new \Exception('UI Component "'.$componentName.'" Not Found!', 1);
	}
}
