<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 px-0">
        <div class="form-group">
            {{-- <label for="helpInputTop">Nama invois (*) </label>
            <small class="text-muted"><i>Bayaran Sewa Bulan Mac 2020</i></small> --}}
            <input type="text" class="form-control shadow-sm alphaonly" maxlength="100" id="invois_item_name"
                name="invois_item_name[]" value="{{ old('invois_item_name') }}">
        </div>
    </div>
    <div class="col-sm-1 col-md-1 col-lg-1 px-1">
        <div class="form-group">
            {{-- <label for="helpInputTop">Unit (*) </label> --}}
            {{-- <small class="text-muted"><i>1</i></small> --}}
            <input type="text" class="form-control shadow-sm alphaonly" maxlength="100" id="invois_unit"
                name="invois_unit[]" value="{{ old('invois_unit') }}">
        </div>
    </div>
    <div class="col-sm-2 col-md-2 col-lg-2 px-1">
        <div class="form-group">
            {{-- <label for="helpInputTop">Harga/Unit (*) </label> --}}
            {{-- <small class="text-muted"><i>1</i></small> --}}
            <input type="text" class="form-control shadow-sm alphaonly" maxlength="100" id="invois_unit_price"
                name="invois_unit_price[]" value="{{ old('invois_unit_price') }}">
        </div>
    </div>
    <div class="col-sm-1 col-md-1 col-lg-1 px-1">
        <div class="form-group">
            <button type="button" class="btn-sm btn-danger form-control delete_item" onclick="deleteme(this)"><i
                    class="fas fa-minus"></i></button>
        </div>
    </div>

</div>
