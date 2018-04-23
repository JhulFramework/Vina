
$( "#{{button_toggle_id}}" ).click
(

	function( )
	{
		var width = $('#{{menu_id}}').css('width');

		$('#{{menu_id}}').css('transition', '{{transition_speed}}s');

		if( width > 0 )
		{
			$('#{{menu_id}}').css('width', '0');

		}
		else
		{
			$('#{{menu_id}}').css('width', '{{menu_width}}');
		}
	}
);


$( "#{{button_open_id}}" ).click
(


	function( )
	{
		$('#{{menu_id}}').css('transition', '0.2s');
		$('#{{menu_id}}').css('width', '{{menu_width}}');
	}
);

$( "#{{button_close_id}}" ).click
(
	function( )
	{
		$('#{{menu_id}}').css('width', '0');
	}
);
