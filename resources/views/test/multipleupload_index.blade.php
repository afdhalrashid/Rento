@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card" style="margin-top: 4%">
            <div class="card-header bg-secondary dark bgsize-darken-4 white card-header">
                <h4 class="text-white">Laravel 7+ Multiple Image File Upload with Live Preview</h4>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    <br>
                @endif
                <form id="file-upload-form" class="uploader" action="{{url('save')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="file-input" onchange="loadPreview(this)" name="image[]"   multiple/>
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                    <div id="thumb-output"></div>
                    <br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

        function loadPreview(input){
       var data = $(input)[0].files; //this file data
       $.each(data, function(index, file){
           if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
               var fRead = new FileReader();
               fRead.onload = (function(file){
                   return function(e) {
                       var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image thumb element
                       img.attr('width',200).attr('height',200);
                       $('#thumb-output').append(img);
                   };
               })(file);
               fRead.readAsDataURL(file);
           }
       });
   }

</script>
@endsection