<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;

class PostController extends Controller
{
    public function index() {
        $posts = DB::table('posts')->get();
        return view('posts/index',compact('posts'));
    }

    public function show($id) {
        // URL'/posts/{id}'の'{id}'部分と主キー（idカラム）の値が一致するデータをpostsテーブルから取得し、変数$postに代入する
        $post = Posts::find($id);

        // 変数$postをposts/show.blade.phpファイルに渡す
        return view('posts/show', compact('post'));
    }

    public function create() {
        return view('posts/create');
    }

    public function store(Request $request) {
        // バリデーションを設定する
        $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|max:200'
        ]);
         // フォームの入力内容をもとに、テーブルにデータを追加する
         $post = new posts();
         $post->title = $request->input('title');
         $post->content = $request->input('content');
         $post->save();
 
         // リダイレクトさせる
         return redirect("/posts/{$post->id}");
     }  
}