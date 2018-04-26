<?php namespace Jhul\Core\Application\Response\WebPage;

/* @Author : Manish Dhruw < 1D3N717Y12@gmail.com >
+=======================================================================================================================
| @ Updated-
| - Saturday 18 April 2015 05:22:09 PM IST
| - Mon 16 Nov 2015 08:46:36 PM IST, [2016-Oct-17, 2016-Nov-05 ]
| - [ 20170709, 2018JAN07 ]
+---------------------------------------------------------------------------------------------------------------------*/

class WebPage
{
	use \Jhul\Core\_AccessKey;

	private $_responseContext = '';

	public function contentTypeHeader() { return 'text/html; charset=utf-8'; }

	public function isEmpty()
	{
		return  empty($this->_responseContext) || !$this->_responseContext->isAccessible() ||  !$this->_responseContext->controller()->ifUIAccessible()   ;
	}

	public function type()
	{
		return 'webpage';
	}

	public function setContext($context )
	{
		$this->_responseContext = $context;
		return $this ;
	}

	public function make()
	{
		if( $this->_responseContext->controller()->ifUIAccessible() )
		{
			$this->_responseContext->controller()->makeWebPage();

			$this->app()->response()->setStatusCode( $this->_responseContext->controller()->statusCode );

			return $this->renderWebPage( $this->_responseContext );
		}
	}

	public function mTime()
	{
		if( empty($this->_mTime) )
		{
			$this->_mTime = new Helper\Time();
		}

		return $this->_mTime ;
	}


	public function renderWebPage( $context )
	{
		$fileRelativeName = $context->_dirNamespace().'/'.$context->resourceKey().'_view.php';

		if( !$this->sysFileStore()->ifFileExists($fileRelativeName) || $context->controller()->ifRefreshWebPage )
		{
			$this->j()->ui()->generateWebPage($context->webPage(), $fileRelativeName, $context->controller()->ifRefreshWebPage  );
		}

		 $context->controller()->dataAdapter()->compile();
		 $context->controller()->set('mData', $context->controller()->dataAdapter() );

		return $this->renderView( $this->sysFileStore()->path().'/'.$fileRelativeName,  $context->controller()->params() );
	}

	public function renderView( $file, $params = [] )
	{
		ob_start();

		extract($params, EXTR_OVERWRITE);

		require($file);

		return ob_get_clean();
	}

	public function sysFileStore()
	{
		return $this->j()->mSysFileStore() ;
	}
}
