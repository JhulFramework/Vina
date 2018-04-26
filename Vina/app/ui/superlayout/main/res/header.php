<style>
.header
{
	display: flex;
	flex-grow: 1;
	padding: 12px;
	padding-left: 24px;

}

.header a
{
	padding: 8px;
	color: #fff;
	font-family: Josefin Sans;
	font-weight: bold;
	letter-spacing: 1px;
	font-size: 24px;
}
</style>

<div class="header" ><a href="<?= $this->app()->url() ?>" ><?= $this->app()->name(); ?></a></div>
