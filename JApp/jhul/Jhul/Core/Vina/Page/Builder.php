<?php namespace Jhul\Core\Application\Page;

abstract class _Class
{

	use \Jhul\Core\_AccessKey;

	//@Param : $layoutFile = file name without extension
	public function compileContent( $layoutFile, $viewFragments )
	{
		$content = '';

		foreach ( $this->layout() as $view )
		{
			$content .= static::loadFileContents( $layoutFile );
		}

		$content =  static::injectFragment( $content, $viewFragments );

		return $content ;
	}

	public static function injectFragment( $content, $fragments = [] )
	{
		if( !empty($fragments) )
		{
			foreach ( $fragments as $key => $value )
			{
				$fragments[ '|{{'.$key.'}}|' ] = $value;
				unset($fragments[$key]);
			}

			$content = preg_replace(array_keys($fragments), array_values($fragments), $content );
		}

		return $content;
	}

	public static function loadFileContents( $file, $extension = 'php' )
	{
		return file_get_contents( $file.'.'.$extension );
	}

	public function cacheContextStyle( $context, $name )
	{
		if( $context->webPage()->mStyle()->hasValue() )
		{
			$styleFileBaseName = $context->dirNamespace().'/',$name;
			$styleFile = $styleFileBaseName.'.css';

			if( !$this->j()->mPubFileStore()->ifFileExists($styleFile) || $context->processor()->ifRefreshWebPage() )
			{
				$this->j()->mPubFileStore()->saveFile
				(
					$context->webPage()->mStyle()->toString(),

					$styleFile
				);
			}
		}
	}

}
