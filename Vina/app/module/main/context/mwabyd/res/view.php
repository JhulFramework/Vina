


<div class="uk-section">
<div class="uk-container" >
	All of android games mentioned here are totally free and offline.<br/>Some games might have ingame purchase items but dont worry you dont need to buy anything to enjoy the game. <br/>IMHO these android games are very good to be free.
</div>
</div>

<?php

$this->getApp()->mResource()->ui()->addJSFile( 'jquery.unveil',  __DIR__.'/jquery.unveil.js' );

$this->getApp()->response()->page()->mJS()->embed('$(document).ready(function() {
  $("img").unveil();
});');


$page_url = $this->getApp()->url().'/Must-Watch-Anime-Before-You-Die' ;

$this->embedCss('style');

$animes = require( __DIR__.'/_animes.php' ) ;

foreach ($animes as $anime): ?>

<div class="game">
<div class="title"><strong><?= $anime['name'] ?></strong></div>

<div class="uk-container uk-text-center uk-padding">
	<img src="bg.png" data-src="<?= $this->getApp()->url() ?>/resources/bfoag/<?= $anime['image'] ?>.png" />
</div>


<div class="c" ><span class="label">ELEMENTS</span>: <span class="elements" ><?= $anime['elements'] ?> </span>  </div>

<div class="c" ><span class="label" >GAMEPLAY</span>: <span class="gameplay" ><?= $anime['gameplay'] ?> </span> </div>

<div class="f" uk-grid>

<div class=" uk-aliogn-center uk-width-1-1 uk-width-expand@s">
<?php if( isset( $anime['youtube'] ) ) : ?>
	<a href="<?= $anime['youtube'] ?>"> YOUTUBE </a>
<?php endif; ?>
</div>

<div class=" uk-aliogn-center uk-width-1-1 uk-width-auto@s" >
	<?php if( isset( $anime['playstore'] ) ) : ?>
	<a href="https://play.google.com/store/apps/details?id=<?= $anime['playstore'] ?>&amp;hl=en" >PLAYSTORE</a>
	<?php endif; ?>
</div>

</div>

</div><!--game -->

<?php endforeach; ?>
