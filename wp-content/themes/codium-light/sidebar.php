<div id="primary" class="sidebar one-third column">
	<ul class="">
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('SidebarTop') ) : // begin primary sidebar widgets ?>	
		<?php endif; // end primary sidebar widgets  ?>
	</ul>
</div>
<!-- #primary .sidebar -->
<div id="secondary" class="sidebar one-third column">
	<ul class="">
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('SidebarBottom') ) : // begin  secondary sidebar widgets ?>
		<?php endif; // end secondary sidebar widgets  ?>
	</ul>
</div>
<!-- #secondary .sidebar -->