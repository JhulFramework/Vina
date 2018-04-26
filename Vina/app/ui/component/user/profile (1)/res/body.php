
<div class="r2c">

<div class="col_left">
			<img src="<?= $host->avatar() ?>" alt="<?= $host->name() ?> image">
</div>

<div class="col_right">
	<div class="_data">
		<div class="name">
	      	<?= $host->name() ?>
		</div>
		<div class="tagline_container">{{tagline}}</div>
		<div class="social" >
			<?php foreach (  $host->profile()->social()->fields() as  $value ) : ?>
				<?= $host->profile()->socialHTML()->makeURL($value) ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>

</div>

<div class="home"><a href="<?= $this->app()->url() ?>" ><i class="icon-feather"></i> </a></div>
