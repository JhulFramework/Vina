{{homeIcon}}
<div class="userinfo">
{{name}}

<div class="quote">

	<?php if( NULL != $host->tagline() ): ?>
	<div class="icon"><i class="icon-quote" ></i></div>
	{{tagline}}
<?php endif; ?>
</div>
<div class="social" >
	<?= (new  \app\ui\component\user\profile\MSocialIcon( $host->profile()->social() ))->toHTML() ; ?>
</div>

</div>
