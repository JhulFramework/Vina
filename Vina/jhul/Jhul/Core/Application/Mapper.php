<?php namespace Jhul\Core\Application;

class Mapper
{
	use \Jhul\Core\_AccessKey;

	private $_contextMap = [];
	private $_muxMap = [];

	private $_prefixIdentifiers =
	[
		'mux'				=> '+',
		'context' 			=> '=',
	];

	private $_suffixIdentifiers =
	[
		'module'				=> '#',
		'addon' 				=> '@',
	];

	public function moduleIdentifier()
	{
		return $this->_suffixIdentifiers['module'] ;
	}

	public function addonIdentifier()
	{
		return $this->_suffixIdentifiers['addon'] ;
	}

	public function setMUXMap( $map )
	{
		$this->_muxMap = $map ;
		return $this;
	}

	public function setContextMap( $map )
	{
		$this->_contextMap = $map ;
		return $this;
	}

	public function muxMap()
	{
		return $this->_muxMap ;
	}

	public function contextMap()
	{
		return $this->_contextMap ;
	}

	public function hasContext( $name )
	{
		return isset( $this->_contextMap[$name] );
	}

	public function hasMUX( $name )
	{
		return isset( $this->_muxMap[$name] );
	}

	public function prefixIdentifiers()
	{
		return $this->_prefixIdentifiers;
	}

	public function suffixIdentifiers()
	{
		return $this->_suffixIdentifiers;
	}

	private function _resolveType( $target )
	{
		foreach( $this->prefixIdentifiers() as $type => $identifier )
		{
			if( 0 === strpos( $target['target'], $identifier)  )
			{
				$target[ $type ] = $target['target'] =  substr( $target['target'], 1 );

				$target['type'] = $type;
				return $target ;
			}
		}

		$target['type'] = '';

		return $target ;
	}

	private function _resolveModule( $target )
	{
		if(  strpos( $target['target'], $this->moduleIdentifier() ) )
		{
			$l = explode( $this->moduleIdentifier(), $target['target'] );

			$target['module'] = $l[0];
			$target['target'] = $l[1];

			$target['domainKey'] = $target['module'].$this->moduleIdentifier();

			return $target ;
		}

		$target['module'] = '';

		return $target ;
	}

	private function _resolveAddon( $target )
	{
		if(  strpos( $target['target'], $this->addonIdentifier() ) )
		{
			$l = explode( $this->addonIdentifier(), $target['target'] );

			$target['addon'] = $l[0];
			$target['target'] = $l[1];
			$target['domainKey'] = $target['domainKey'].$target['addon'].$this->addonIdentifier();

			return $target ;
		}

		$target['addon'] = '';

		return $target ;
	}

	public function identifyResource( $name )
	{
		$res['key'] =  $name;
		$res['target'] =  $name;
		$res = $this->_resolveType( $res );
		$res = $this->_resolveModule( $res );
		$res = $this->_resolveAddon( $res );
		return $res ;
	}

	public function resolve( $name )
	{

		$res = $this->identifyResource( $name );


		if( !$this->app()->mDomain()->ifDomainInstalled($res['domainKey']) )
		{
			if( !empty($res['module']) )
			{
				$m = $this->app()->m( $res['module'] ) ;

				if( !empty($res['addon']) )
				{
					$m->a( $res['addon'] );
				}
			}
		}

		if( !isset($res['context']) && !isset($res['mux']) )
		{
			throw new \Exception( 'inavlid route formate  "'.$res['key'].'" ' , 1);
		}

		$res['resource'] = ('context' == $res['type']  ) ? $this->getContextClass( $res['context'] ) : $this->getMUXClass( $res['mux'] ) ;

		return $res;
	}


	public function registerMUXMap( $domainKey, $map  )
	{
		foreach ($map as $name => $class)
		{
			$key = $domainKey.$name;

			if( isset( $this->_muxMap[$key] ) )
			{
				throw new \Exception( 'resource key "'.$key.'" already used for resource "'.$class.'" ' , 1);
			}

			$this->_muxMap[$key] = $class;
		}

		return $this ;
	}

	public function registerContextMap( $domainKey, $map  )
	{
		foreach ($map as $name => $class)
		{
			$key = $domainKey.$name;

			if( isset( $this->_contextMap[$key] ) )
			{
				throw new \Exception( 'resource key "'.$key.'" already used for resource "'.$class.'" ' , 1);
			}

			$this->_contextMap[$key] = $class;
		}

	//	array_multisort( array_map('strlen', $this->_contextMap), $this->_contextMap);
		//
		// $this->_contextMap = array_reverse( $this->_contextMap );

		return $this ;
	}

	// public function registerContextMap( $domainKey, $map  )
	// {
	// 	$this->_register( $this->contextIdentifier().$domainKey, $map );
	// }

	public function getContextClass( $key, $required = TRUE )
	{
		if( $this->hasContext($key) )
		{
			return $this->_contextMap[$key] ;
		}

		if( $required )
		{
			$resource = $this->identifyResource( $key );

			if( empty($resource['type']) )
			{
				$resource['type'] = 'unknown';
			}

			throw new \Exception( ucfirst($resource['type']).' resource "'.$key.'" not found' , 1);
		}
	}

	public function getMUXClass( $key, $required = TRUE )
	{
		if( $this->hasMUX($key) )
		{
			return $this->_muxMap[$key] ;
		}

		if( $required )
		{
			$resource = $this->identifyResource( $key );

			if( empty($resource['type']) )
			{
				$resource['type'] = 'unknown';
			}

			throw new \Exception( ucfirst($resource['type']).' resource "'.$key.'" not found' , 1);
		}
	}


	public function contextIdentifier()
	{
		return $this->_prefixIdentifiers['context'];
	}

	protected function loadConfigFile( $file, $required = TRUE )
	{
		return $this->J()->fx()->loadConfigFile( $file, $required );
	}

	public function _register( $prefix, $map )
	{
		foreach ($map as $name => $namespace)
		{
			$this->_add( $prefix.$name, $namespace  ) ;
		}
	}

	public function muxIdentifier()
	{
		return $this->_prefixIdentifiers['mux'];
	}


	public function getByNamespace( $namespace )
	{
		$pos = strrpos( $namespace, '_\\' );

		$rContext = substr( $namespace, 0, $pos+1 ).'\\Context';

		$key = array_search( $rContext, $this->map() );

		if( $key )
		{
			return $this->get($key) ;
		}

		throw new \Exception( 'Context Not Defined For Class "'.$namespace.'"' , 1);
	}

}
