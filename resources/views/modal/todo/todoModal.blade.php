<div class="modal" tabindex="-1" role="dialog" id="modalTask" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tugasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="task_form" name="task" method="post" action="{{ route('todos.store') }}">
                    @csrf()
                    <div class="form-group">
                        <label for="todoTitle_id">Tajuk</label>
                        <input type="text" class="form-control" id="todoTitle_id" name="title" data-input="title">
                    </div>

                    <div class="form-group" id="body">
                        <label for="tasks">Notes</label>
                    </div>

                    <div class="form-group row mt-2 mb-0">
                        <label for="dateline" class="col-sm-4 col-md-4 col-lg-4 col-form-label">Tarikh perlu
                            siap</label>
                        <div class="col-sm-4">
                            <input type="text" name="dateline" id="dateline"
                                class="form-control form-control-sm datepicker">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="day_notify" class="col-sm-4 col-md-4 col-lg-4  col-form-label">ingatkan saya</label>
                        <div class="col-sm-2">
                            <input type="text" name="day_notify" id="day_notify" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">hari sebelum tarikh perlu siap</div>
                    </div>

                    <div class="form-group mt-4">
                        <button class="btn btn-primary btn-sm" id="submit-form">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @yield('modalFooter')
            </div>
        </div>
    </div>
</div>
