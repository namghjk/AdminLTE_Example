<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewPost;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.page.post.add', [
            'title' => 'Add new post',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewPost $request)
    {
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(\public_path("thumbnail/"), $imageName);

            $post = new Post([
                'name' => $request->name,
                'description' => $request->description,
                'thumbnail' => $imageName,
            ]);
            $post->save();
        }

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request['post_id'] = $post->id;
                $request['image']  = $imageName;
                $file->move(\public_path("/images"), $imageName);
                Image::create($request->all());
            }
        }

        Session::flash('success', 'Add new post successfully');

        return redirect(route('newPost'));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $posts = Post::all();
        return view('admin.page.post.index', [
            'title' => 'All post',
        ])->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $posts = Post::findOrFail($id);
        return view('admin.page.post.update', ['title' => 'Edit ' . $posts->name])->with('posts', $posts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewPost $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($request->hasFile('thumbnail')) {
            if (File::exists("thumbnail/" . $post->cover)) {
                File::delete("thumbnail/" . $post->cover);
            }
            $file = $request->file('thumbnail');
            $post->thumbnail = time() . '_' . $file->getClientOriginalName();
            $file->move(\public_path("/thumbnail"), $post->thumbnail);
            $request['thumbnail'] = $post->thumbnail;
        }

        $post->update([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $post->thumbnail
        ]);

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request["post_id"] = $id;
                $request["image"] = $imageName;
                $file->move(\public_path("images"), $imageName);
                Image::create($request->all());
            }
        }
        return redirect(route('showAll'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        if (File::exists("thumbnail/" . $posts->cover)) {
            File::delete("thumbnail/" . $posts->cover);
        }

        $images = Image::where("post_id", $posts->id)->get();
        foreach ($images as $image) {
            if (File::exists("images/" . $image->image)) {
                File::delete("images/" . $image->image);
            }
        }
        $posts->delete();
        $posts->images()->delete();
        return back();
    }

    public function deleteImage($id)
    {
        $images = Image::findOrFail($id);
        if (File::exists("images/" . $images->image)) {
            File::delete("images/" . $images->image);
        }
        Image::find($id)->delete();
        return back();

    }

    public function deleteThumbnail($id){
        $posts = Post::findOrFail($id);
        if (File::exists("thumbnail/" . $posts->thumbnail)) {
            File::delete("thumbnail/" . $posts->thumbnail);
        }
        return back();
    }

}
