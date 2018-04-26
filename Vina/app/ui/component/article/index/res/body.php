{{articleIndexActionbar}}
<div class="article-list">
<?php foreach ( $mData->items() as $item ):?>
<div class="article">
<div class="title"><?= $item->title() ?></div>

<div class="meta" >
	<span class="time"><?= $this->mTime()->toDate($item->editedOnTime()) ?></span><span> <a style="color:#70869b;" class="author" href="<?= $item->author()->url() ?>"><?= $item->author()->name() ?></a> </span>
</div>


<div class="preview">
	<div class="content"><?= $item->preview(); ?> . . . </div>
</div>

<div class="bottom">{{articlePanelView}}</div>

</div>

<?php endforeach; ?>

</div>
