### WEB GUI Generator
Vina is a PHP library for WEB GUI(HTML, CSS, JAVASCRIPT) Generation. It is based on css flex.

### Requirement

 - PHP Version >= 5.6
 - JApp/\_data directory must be writable by PHP


### Including in your project

- Clone or download this repository
- Add the following code

```php
require_once( '/path/to/vina/bootJApp.php' );
createJApp();
```

### Example
```php
<?php require_once( __DIR__.'/bootJApp.php' );

$view = new \Jhul\Core\Vina\View\Element('sample');

$view
->centerX()
->centerY()
->setColor('#ccc')
->setFontSize(24)
->setBackground('#242424')
->setContent('Super Cool Layout Generated Using VINA')
->growHeight();

$view->compile(); //IMPORTANT

echo $view->embed();
```
### OUTPUT
![html](screenshot.png?raw=true "php gui screenshot")

###API
```php

//CALL AFTER COMPILING

//compiled content Including style script and html
// browser will render it
$view->embed();

//show raw output, visible on browser
$view->show();

//to see compiled content
$view->showContent();


//returns compiled content, use view source code
$view->compiledContent();

//returns compiled style
$view->compiledStyle();

//returns compiled compiled javascript
$view->compiledScript();

```

### Note
- This libray can generate forms, templates but documentation might take time.
- More example are available inside "example" directory
