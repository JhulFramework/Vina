<?php namespace Jhul\Core\Application\Response\Webpage\Helper ;

class Time
{

	private $_timeLength =
	[
		12 * 30 * 24 * 60 * 60  =>  'साल',
		30 * 24 * 60 * 60       =>  'माह',
		24 * 60 * 60            =>  'दिन',
		60 * 60                 =>  'घंटे',
		60                      =>  'मिनट',
		1                       =>  'सेकेंड्स'
	];

	public function ago( $time )
	{
		$time_elapsed = time() - $time;

		if( $time_elapsed < 1 )
		{
			return 'अभी';
		}

		foreach( $this->_timeLength as $secs => $str )
		{
			$d = $time_elapsed / $secs;

			if( $d >= 1 )
			{
				$r = round( $d );
            		return $r . ' ' . $str . ' पहले';
			}
		}
	}

	public function toDate( $time)
	{
		return date( 'd M Y', $time ) ;
	}

}
