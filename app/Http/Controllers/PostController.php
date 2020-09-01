<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\Posts;
use App\Category;
use App\Tags;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Posts::orderBy('id','desc')->paginate(10);
        return view('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $category = Category::all();
        return view('admin.post.create', compact('category','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul'         => 'required',
            'category_id'   => 'required',
            'content'       => 'required',
            'gambar'        => 'required'
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $post = Posts::create([
            'judul'         => $request->judul,
            'category_id'   => $request->category_id,
            'content'       => $request->content,
            'gambar'        => 'public/uploads/posts/'.$new_gambar,
            'slug'          => Str::slug($request->judul),
            'users_id'       => Auth::id()
        ]);

        // select multi input
        $post->tags()->attach($request->tags);

        $gambar->move('public/uploads/posts/', $new_gambar);
        return redirect()->route('post.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $tags = Tags::all();
        $post = Posts::findorfail($id);
        return view('admin.post.edit', compact('post','tags','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul'         => 'required',
            'category_id'   => 'required',
            'content'       => 'required'
        ]);

        $post = Posts::findorfail($id);


        // jika menyertakan gambar di input post maka if
        if ($request->has('gambar')) {
            $gambar = $request->gambar;
            $new_gambar = time().$gambar->getClientOriginalName();
            $gambar->move('public/uploads/posts/', $new_gambar);

        $post_data = [
            'judul'         => $request->judul,
            'category_id'   => $request->category_id,
            'content'       => $request->content,
            'gambar'        => 'public/uploads/posts/'.$new_gambar,
            'slug'          => Str::slug($request->judul)
        ];
        // jika tidak menyertakan gambar pada post maka else
        }
        else{
        $post_data = [
            'judul'         => $request->judul,
            'category_id'   => $request->category_id,
            'content'       => $request->content,
            'slug'          => Str::slug($request->judul)
        ];
        }
        

        // select multi input sinkron
        $post->tags()->sync($request->tags);
        $post->update($post_data);

        return redirect()->route('post.index')->with('success', 'Data berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findorfail($id);
        $post->delete();

        return redirect()->back()->with('success','Data berhasil dihapus (Cek Trashed Post)');
    }

    public function tampil_hapus()
    {
        $post = Posts::onlyTrashed()->paginate(10);
        return view('admin.post.hapus', compact('post'));
    }

    public function restore($id)
    {
        $post = Posts::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect()->back()->with('success','Data berhasil di Restore (Cek Post List)');
    }

    public function kill($id)
    {
        $post = Posts::withTrashed()->where('id', $id)->first();
        $post->forceDelete();

        return redirect()->back()->with('success','Data berhasil di Delete Permanen');
    }
}
