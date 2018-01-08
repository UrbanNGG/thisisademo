<?php
if(!isset($p))
{
	header("Location: ./index.php?p=dashboard");
}
?>

<aside class="sidebar offscreen-left">
	<nav class="main-navigation" data-distance="0" data-height="auto" data-rail-visible="true" data-size="6px" data-wheel-step="10">
		<p class="nav-title">MENU</p>
		<ul class="nav">
			<?php displayPages();?>

	</nav>
</aside>
