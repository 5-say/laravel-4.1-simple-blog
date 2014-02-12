<?php $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator); ?>

@if($paginator->getLastPage()>1)
	<ul class="pager" style="font-size:0.5em;margin-top:-0.5em;">
		{{ $presenter->getPrevious('&laquo; 上一页', 'previous') }}
		{{ $presenter->getNext('下一页 &raquo;') }}
	</ul>
@endif
