<?= $this->breadcrumbs() ?>
<style type="text/css">
.uk-card-body
{
	background: #30363f;
}
</style>


<div class="uk-section">


<div class="uk-width-1-1 uk-width-large@s uk-align-center uk-padding-small">

<?php foreach( $items as $name => $param  ): ?>

<div class="uk-card uk-card-small uk-card-secondary uk-margin">
    <a href="<?= $base_url.$name ?>"><div class="uk-card-body">
          <h4 class="uk-card-title uk-margin-remove-bottom " style="color: #e0e6ef;"><?= $param['label'] ?></h4>
    </div>
    </a>
</div>

<?php endforeach; ?>

</div>
</div>
