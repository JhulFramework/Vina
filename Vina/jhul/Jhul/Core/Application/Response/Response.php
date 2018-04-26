<?php namespace Jhul\Core\Application\Response;

class Response
{

	const WEBPAGE_ADAPTER = 'webpage';
	const JSON_ADAPTER = 'json';

	//http version
	public $version = '1.1';

	protected $_ifStatusCodeSet = FALSE ;

	public $statusCode;

	public $statusText;

	//Data Adpater Key
	protected $_mode;

	private $_jsonAdapter;
	private $_webpageAdapter;


	protected $_dataAdapters =
	[
		'json'	=> __NAMESPACE__.'\\JSON\\JSON',
		'webpage'	=> __NAMESPACE__.'\\WebPage\\WebPage',
	];

	protected $_statusCodes = [ ];

	public function __construct( $adapterKey )
	{

		$this->_statusCodes = require( __DIR__.'/_status_codes.php' );

		$this->setStatusCode(200);

		$this->setModeTo( $adapterKey );
	}

	public function setModeTo( $adapterKey )
	{
		$this->_mode = $adapterKey;

		return $this ;
	}

	public function webPageAdapter()
	{
		if( empty($this->_webpageAdapter) )
		{
			$class = $this->_dataAdapters[ static::WEBPAGE_ADAPTER ];
			$this->_webpageAdapter = new $class;
		}

		return $this->_webpageAdapter ;
	}

	public function jsonAdapter()
	{
		if( empty($this->_jsonAdapter) )
		{
			$class = $this->_dataAdapters[ static::JSON_ADAPTER ];
			$this->_jsonAdapter = new $class;
		}

		return $this->_jsonAdapter ;
	}

	public function isEmpty()
	{
		return $this->page()->isEmpty();
	}

	public function page()
	{
		if( $this->_mode === static::WEBPAGE_ADAPTER )
		{
			return $this->webPageAdapter() ;
		}

		if( $this->_mode === static::JSON_ADAPTER )
		{
			return $this->jsonAdapter() ;
		}
	}

	public function ifStatusCodeSet()
	{
		return $this->_ifStatusCodeSet;
	}

	public function setStatusCode( $code, $text = NULL )
	{
		$this->_ifStatusCodeSet = TRUE;

		if( empty($text) )
		{
			$text = $this->_statusCodes[$code];
		}

		$this->statusCode = $code;

		$this->statusText = $text;

		return $this;
	}

	public function send()
	{
		$this->sendHeaders();

		$this->sendPage();
	}

	public function sendPage()
	{
		echo $this->page()->make();
	}

	protected $_headers = [];

	public function addHeader( $key, $value )
	{
		$this->_headers[ $key ] = $value;
		return $this;
	}

	public function sendHeaders()
	{
		if( empty( $this->_headers['Content-Type'] ) )
		{
			$this->_headers['Content-Type'] =  $this->page()->contentTypeHeader();
		}

		if ( !headers_sent() )
		{
			header( 'HTTP/'.$this->version.' '.$this->statusCode.' '.$this->statusText );

			foreach ($this->_headers as $key => $value)
			{
				header( $key.': '.$value );
			}
		}
	}
}
