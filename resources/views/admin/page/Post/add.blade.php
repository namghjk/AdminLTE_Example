@extends('admin.partial.main')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card-body">
        <div class="form-group">
            <form action="{{route('addPost')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="name">Name</label>
                <input type="text" class="form-control" name='name' placeholder="Enter name">
                <label for="description">Desciption</label>
                <textarea type="text" class="form-control" id="description" name='description'
                    placeholder="Enter description"></textarea>

                <label class="m-2">Thumbnail Image</label>
                <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="thumbnail">

                <label class="m-2">Images</label>
                <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]" multiple>


                <button type="submit" class="btn btn-danger col-1  mt-5 float-right">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
