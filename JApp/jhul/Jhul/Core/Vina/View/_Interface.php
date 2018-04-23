<?php namespace Jhul\Core\Vina\View;


/* @Author : Manish Dhruw
+-----------------------------------------------------------------------------------------------------------------------
| @Created : 10NOV2017
+=====================================================================================================================*/

interface _Interface
{

	/*
	| return everything as HTML embeddable including style content and script
	*/
	public function embed();

	/*
	| compiles everything ( content, style, script)
	+------------------------------------------------*/
	public function compile();

	/*
	| Compile style on call and return as string
	+------------------------------------------------*/
	//protected function compileContent();

	/*
	| Compile style on call and return as string
	+------------------------------------------------*/
	public function compileStyle();

	/*
	| Compile javascript on call and return as string
	*/
	public function compileScript();

	/*
	| @returns HTML Content without style content and script
	*/
	public function compiledContent();


	/*
	| return name of view element/layout
	*/
	public function name();

	//returns Style manager
	public function style();

	//returns script
	public function script();

	/*
	| return compiled script as html embedable
	| example <script>script</script>
	| return null on empty
	*/
	public function scriptAsHTML();


}
