<div class="uk-section">
<div class="uk-container" >
	All of android games mentioned here are totally free and offline.<br/>Some games might have ingame purchase items but dont worry you dont need to buy anything to enjoy the game. <br/>IMHO these android games are very good to be free.
</div>
</div>

<?php

$this->getApp()->mResource()->ui()->addJSFile( 'jquery.unveil',  __DIR__.'/jquery.unveil' );

$this->getApp()->response()->page()->mJS()->embed('$(document).ready(function() {
  $("img").unveil();
});');


$page_url = $this->getApp()->url().'/Best-Free-Offline-Android-Games' ;

$this->embedCss('style');



foreach ( $items  as $game): ?>

<div itemscope itemtype="http://schema.org/Game" class="game">
<div class="title"><strong itemprop="name"><?= $game['name'] ?></strong></div>

<div class="uk-container uk-text-center uk-padding">
	<img src="bg.png" data-src="<?= $this->getApp()->url() ?>/resources/bfoag/<?= $game['image'] ?>.png" />
</div>


<div class="c" ><span class="label">ELEMENTS</span>: <span class="elements" ><?= $game['elements'] ?> </span>  </div>

<div class="c" ><span class="label" >GAMEPLAY</span>: <span class="gameplay" itemprop="description" ><?= $game['gameplay'] ?> </span> </div>

<div class="f" uk-grid>

<div class=" uk-aliogn-center uk-width-1-1 uk-width-expand@s">
<?php if( isset( $game['youtube'] ) ) : ?>
	<a href="<?= $game['youtube'] ?>"> YOUTUBE </a>
<?php endif; ?>
</div>

<div class=" uk-aliogn-center uk-width-1-1 uk-width-auto@s" >
	<?php if( isset( $game['playstore'] ) ) : ?>
	<a href="https://play.google.com/store/apps/details?id=<?= $game['playstore'] ?>&amp;hl=en" >PLAYSTORE</a>
	<?php endif; ?>
</div>

</div>

</div><!--game -->

<?php endforeach; ?>
