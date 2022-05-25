<div class="modal" tabindex="-1" role="dialog" id="modalDeleteTask" style="display: none;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mesej</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                {{-- @csrf() --}}
                @method('DELETE')
                <input type="button" name="buttonDelete" class="btn btn-sm btn-secondary delete" value="Delete"
                    data-link="" data-delete="">
            </div>
        </div>
    </div>
</div>
