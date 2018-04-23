<div class="r2c">

<div class="col_left">
	<div class="roomlist" >
			<?php foreach ( $rooms as $room ): ?>
				<div class="room">
					<div class="icon"><i class="icon-quote" ></i></div>
					<span class="name" ><?= $room->name() ?> <span class="pop"> (<?= $room->countUsers().'/',$room->userPopCap() ?>)</span> </span>
					<div><a href="<?= $room->url() ?>"><div><i class="icon-spin animate-spin"></i></div></a></div>
				</div>
			<?php endforeach ; ?>
	</div>
</div>

<div class="col_right">
	<div class="" >{{rules}}

	</div>
</div>

</div>
