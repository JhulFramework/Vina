<?php namespace Jhul\Core\Vina\View;


trait _HasResource
{
	public function styleResources(){}
	public function scriptResources(){}

	protected function _loadFile( $file, $ext )
	{
		return file_get_contents( $file.'.'.$ext );
	}

	private function _loadLocalFile( $file , $ext)
	{
		return $this->_loadFile( $this->resDirPath().'/'.$file, $ext  );
	}

	public function loadStyleResources() { return $this->_loadResources( $this->styleResources(), 'css' ); }

	public function loadScriptResources() { return $this->_loadResources( $this->scriptResources(), 'js' ); }


	public function _loadResources( $map, $ext )
	{
		if( !is_array($map) || empty($map) ) return '' ;

		$res = '';
		foreach ( $map as $k => $r)
		{
			$res .= $this->_load($k, $r, $ext);
		}

		return $res ;
	}

	public function _load( $key, $name, $ext )
	{
		return ctype_alpha($key) ? $this->_loadFile($name, $ext) : $this->_loadLocalFile($name, $ext);
	}

	abstract public function resDirPath();
}
