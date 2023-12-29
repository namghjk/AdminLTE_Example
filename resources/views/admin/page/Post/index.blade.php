@extends('admin.partial.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Responsive Hover Table</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Desciption</th>
                        <th>Thumbnail</th>
                        <th>Created at</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->name }}</td>
                        <td>{{ strip_tags($post->description) }}</td>
                        <td><img src="/thumbnail/{{ $post->thumbnail }}" class="img-responsive"
                                style=" max-height:100px; max-width:100px" alt="" /></td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <a href="{{ route('editPost', $post->id) }}" class="btn btn-outline-primary ">Update</a>
                        </td>
                        <td>
                            <form action="{{ route('deletePost', $post->id) }}" method="POST">
                                <button class="btn btn-outline-danger " type="submit"
                                    onclick="return confirm('Are you sure?');">Delete</button>

                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
