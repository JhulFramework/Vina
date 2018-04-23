<?php namespace Jhul\Core;

/* @Author : Manish Dhruw [1D3N717Y12@gmail.com]
+=======================================================================================================================
| @Updated : 2017-Aug-30
+---------------------------------------------------------------------------------------------------------------------*/
trait _AccessKey
{

	private $_addonKey ;

	private $_moduleKey ;

	private $_context ;

	private $_domainType ;

	public function J()
	{
		return \Jhul::I();
	}

	public function app()
	{
		return $this->J()->app() ;
	}


	public function context()
	{
		if( empty($this->_context) )
		{
			$this->_context = $this->_m()->getContextByNamespace( get_called_class() );
		}

		return $this->_context ;
	}



	final public function _m()
	{
		if( NULL == $this->_moduleKey )
		{
			$paths = explode('\\', trim( get_called_class(), '\\' ) );

			$k = array_search( '_m', $paths );

			if( 0 === $k )
			{
				$k = $paths[1] ;
			}

			if( FALSE === $k )
			{
				throw new \Exception( 'This class "'.get_called_class().'" is not a part of any module' , 1);
			}

			$this->_moduleKey = strtolower( $paths[ $k + 1 ] );
		}

		return $this->app()->m( $this->_moduleKey );
	}

	final public function _a()
	{
		if( NULL == $this->_addonKey )
		{
			$namespace =  trim( get_called_class(), '\\' );

			$identifier = '_m\\'.$this->_m()->_name().'\\addon\\';

			if( 0 === strpos( $namespace, $identifier ) )
			{
				$slug = explode( '\\', str_replace($identifier, '', $namespace ) );
				$this->_addonKey = $slug[0];
			}

			if( empty($this->_addonKey) )
			{
				throw new \Exception( 'This class "'.get_called_class().'" is not a part of any Addon' , 1);
			}
		}

		return $this->_m()->addon($this->_addonKey);
	}

	final public function _d()
	{
		if( empty($this->_domainType) )
		{
			if( 0 === strpos(get_called_class(), '_m\\' ) )
			{
				$this->_domainType = 'module';

				if( 0 === strpos(get_called_class(), '_m\\'.$this->_m()->_name().'\\addon\\' ) )
				{
					$this->_domainType = 'addon';
				}
			}
		}

		if( $this->_domainType == 'module' )
		{
			return $this->_m() ;
		}

		if( $this->_domainType == 'addon' )
		{
			return $this->_a() ;
		}

		throw new \Exception( 'This Object Has No Domain' , 1);

	}

}
