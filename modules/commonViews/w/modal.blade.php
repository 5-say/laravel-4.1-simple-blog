<!-- Modal -->
<div class="modal fade" id="{{ $modal['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">{{ $modal['title'] }}</h4>
            </div>
            <div class="modal-body">
                {{ $modal['message'] }}
            </div>
            <div class="modal-footer">
                {{ $modal['footer'] }}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->