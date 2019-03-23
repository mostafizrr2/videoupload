@extends('layouts.app')


@push('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">

@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload video</div>
                {{-- {{ route('video.store') }} --}}

                <div class="card-body">
                    {{-- <div id="label">
                        <label for="file" id="thumbnail" style="margin:0 auto;">
                            <img class="img-thumbnail thumbnail" src="upload.jpg"> 
                        </label>
                    </div> --}}   

                    {{-- <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" id="file"> 
                        <input type="submit" value="Upload">
                    </form> --}}
        
                    <upload-component  
                        route="{{ route('video.store') }}"
                        action="{{ route('store.all') }}"
                        csrf="{{ csrf_token() }}" >

                    </upload-component>

                  <br><br>  
                  
                  <media-button field="featured"></media-button>
                  <br>
                  <img id="featuredImage" src="" alt="" width="200px">
                  Feartured Image <input id="featuredImageValue"  type="text" value="">
    
                  <hr><br> 
                  <media-button field="post"></media-button>
                  <br>
                  <textarea id="editor"></textarea>   


                  <br>
                  {{-- <media-button field="portfolio"></media-button> --}}
                  {{-- <br><br> --}}

                  
                  {{-- <br><br>
                  <img id="postImage" src="" alt="" width="200px">
                  Post Image <input id="postImageValue"  type="text" value=""> --}}

                  

                  {{-- <br><br>
                  <img id="portfolioImage" src="" alt="" width="200px">
                  Portfolio image <input id="portfolioImageValue"  type="text" value=""> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<!--Wysiwig js-->
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
tinymce.init({
    selector: "textarea#editor",
    theme: "modern",
    height:300,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
    style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
});
</script>
@endpush
