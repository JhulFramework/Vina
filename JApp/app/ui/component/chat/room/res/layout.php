
<div class="room">

<div class="r2c">
<div class="message_list">
<?php foreach( $room->fetchMessages() as $m ): ?>

<div class="message">

	<div class="top">
		<div class="icon"><i class="icon-quote"></i></div>
		<div class="sender"> <?= $m->sender() ;?> </div>
		<div class="time"><?= $this->j()->ui()->mTime()->ago( $m->time() ) ; ?> </div>
	</div>


	<div class="content"><?= $m->content() ?></div>
</div>

<?php endforeach; ?>
</div>

<div class="right" >
	{{form}}
<div class="bottom"><a href="<?= $form->room()->url() ?>/?a=userlist"><i class="icon-user" ></i><?= $room->countUsers() ?> </a></div>
</div>

</div>

</div>
