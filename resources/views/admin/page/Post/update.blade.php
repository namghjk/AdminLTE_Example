@extends('admin.partial.main')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card-body">
        <div class="form-group">
            <form action="{{ route('updatePost', $posts->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="name">Name</label>
                <input type="text" class="form-control" name='name' placeholder="Enter name" value="{{ $posts->name }}">
                <label for="description">Desciption</label>
                <textarea type="text" class="form-control" id="description" name='description' placeholder="Enter description">{{ strip_tags($posts->description) }}</textarea>

                <label class="m-2">Thumbnail Image</label>
                <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="thumbnail">
                <div class="col-lg-12 d-flex">
                    <div>
                        <label class="m-2">Thumbnail Image</label>
                        <img src="/thumbnail/{{ $posts->thumbnail }}" class="img-responsive"
                            style="max-height: 100px; max-width:100px" alt srcset="" />
                    </div>
                </div>



                <label class="m-2">Images</label>
                <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]" multiple>


                <button type="submit" class="btn btn-danger col-1  mt-5 float-right">Update</button>
            </form>

            <div class="row">

                <div class="col-lg-6">
                    <div class="row">
                        @if (count($posts->images) > 0)
                            <label class="m-2">Details Images</label>
                            @foreach ($posts->images as $image)
                                <div class="col-lg-12 d-flex">
                                    <div>
                                        <img src="/images/{{ $image->image }}" class="img-responsive"
                                            style="max-height: 100px; max-width:100px" alt srcset="" />
                                    </div>
                                    <div>
                                        <form action="{{ route('deleteImage', $image->id) }}" method="POST">
                                            <button class="btn btn-danger">X</button>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>


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
