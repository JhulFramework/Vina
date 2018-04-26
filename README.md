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



### Media Query
```php
//for screen width less than 480px
$view->onMaxScreenWidth(480)->setColor('#408');

//for screen width larger than 480px
$view->onMinScreenWidth(481)->setColor( '#242424' );
```



### Hover Effect
```php
$view->onHover()->setColor('#999');
```



### Border
```php
$view->border()->setStyleSolid()->setwidth(2)->setColor('#666');
```


### HTML Link
```php
$view->setURL( $url ) ; //generated html will be a link
```


### API (call after compile)
```php
// returns compiled content Including style script and html
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



### STYLING API(call before compile)
```php
$view->setColor('#111');//font color

$view->setBackground('#aaa');

$view->setFontSize(20);//20px

$view->setPadding(12);

//vertical padding
$view->setPaddingV(12);

//horizontal padding
$view->setPaddingH(12);

//fill remaining space
$view->growWidth();
$view->growHeight();

$view->setWidth(100);//100px
$view->setHeight(100);

$view->setFontFamily(12);

//center content horizontaly
$view->centerX();

//center content verticaly
$view->centerY();

//align childrens in row
$view->setOrientationVertical();
$view->enableWrap();

//align childrens in column
$view->setOrientationHorizontal();

```



### Style Unit
```php
$view->setWidth(100);//100px
$view->setWidth('100px');//100px

$view->setWidth('100%');//100%

$view->setWidth('100em');//100em
```



### Note
- If you find this project useful, please give it a star it will motiavte me.
- This libray can generate forms, templates but documentation might take time.
- More example are available inside "example" directory
- You dont need to use this code in you production server, copy generated output and paste it in your view template
