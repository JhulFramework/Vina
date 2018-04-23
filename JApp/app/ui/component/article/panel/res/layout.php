<?php $mButton = new \app\ui\component\article\panel\UI( $item ); $mButton->setIfMember( $this->app()->user()->isMember() );  ?>

<div class="article_panel">{{article_panel_content}}</div>
