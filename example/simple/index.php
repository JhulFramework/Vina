<?php require_once( dirname(dirname(__DIR__)).'/bootVina.php' );




require( __DIR__.'/Element.php' );


$item = new \Element('sample');

$item->setContent('VINA. A PHP GUI Generator')->setColor('#c0c6cb');

$item->setBackground('#121212');
$item->growHeight();

$item->center();


//compile html, css and javascript
$item->compile();


echo  $item->embed() ;
