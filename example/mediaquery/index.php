<?php require_once( dirname(dirname(__DIR__)).'/JApp/include_me.php' ); createJApp(__DIR__);




$item = new \Element('sample');

$item->setContent('VINA. A PHP GUI Generator. Media query Example');

$item->setBackground('green');
$item->growHeight();

$item->center();


//Media Query
$item->onMaxScreenWidth(480)->setBackground('grey')->setColor('cyan');


//compile html, css and javascript
$item->compile();

echo  $item->embed() ;
