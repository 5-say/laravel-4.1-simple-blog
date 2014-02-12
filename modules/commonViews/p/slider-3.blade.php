<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

<ul class="pagination pagination-sm">
    {{ $presenter->render() }}
</ul>
