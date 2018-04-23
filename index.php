<?php require_once( __DIR__.'/bootJApp.php' );



$layout = new \Jhul\Core\Vina\View\Element\Composite('sample');

$layout
->setBackground('#121212')
->growHeight()
->growWidth()
->setFlexDirectionColumn()

->center();

$layout->addChild('top', 'Super Cool Layout Generated Using VINA' )
->setPaddingV(36)
->setColor('#ccc')
->setFontSize(24);

$layout->addChild('bottom', 'SEE MORE EXAMPLES' )
->setPadding(12)
->setColor('#ccc')
->setURL('example')
->_styleSet('text-decoration', 'none')
->setFontSize(16);

$layout->child('bottom')->border()->setStyleSolid()->setWidth(1);

$layout->compile();

echo $layout->embed();
