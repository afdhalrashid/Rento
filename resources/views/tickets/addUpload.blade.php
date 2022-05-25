{{-- <div class="my-1">
    <div class="input-group">
        <div class="custom-file">
            <input id="img1" type="file" name="files[]" class="custom-file-input chooseFile">
            <label class="custom-file-label" for="chooseFile">Muatnaik</label>
        </div>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary mx-2 remove_new_upload_element" type="button"><i class="fas fa-trash-alt"></i></button>
            </div>
    </div>
    <div class="row">
        <img src="#" width="300px" height="250px" style="display: none;padding:1rem;"  />
    </div>
    @if ($errors->has('message'))
        <span class="help-block">
            <strong class="error">{{ $errors->first('message') }}</strong>
        </span>
    @endif
</div> --}}

<div class="my-1">
<div class="custom-file">
    <input id="img1" type="file" name="files[]" class="custom-file-input chooseFile" onchange="readURL2(this)">
    <label class="custom-file-label" for="chooseFile">Muatnaik</label>
</div>
{{-- <div class="input-group-append">
<button id="add_new_upload_element" class="btn btn-outline-secondary mx-2" type="button"><i class="fas fa-plus"></i></button>
</div> --}}

<div class="row">
<img src="#" width="300px" height="250px" style="display: none;padding:1rem;"  />   <!--for preview purpose -->
</div>
@if ($errors->has('message'))
<span class="help-block">
    <strong class="error">{{ $errors->first('message') }}</strong>
</span>
@endif
</div>