<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

use Illuminate\Support\Facades\DB;



class BlogController extends Controller
{
    // ブログの全権取得
    public function showList() {

        $blogs = Blog::all();

        return view('blog.list',
        [
            'blogs' => $blogs,
        ]);

        // return view('a');

    }


    // ブログのある詳細データ
    public function showDetail($id) {

        $blog = Blog::find($id);

        return view('blog.detail',
        [
            'blog' => $blog,
        ]);

    }


    public function showCreate() 
    {
        return view('blog.form');
    }


    public function exeStore(Request $request) 
    {

        // ブログのデータを受け取る
        // $inputs = $request->all();


        $blog = new Blog;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();


        // ブログを登録
        // Blog::create($inputs);

        return redirect(route('blogs'));
    }

    /**
     * ブログ編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $blog = Blog::find($id);

        if (is_null($blog)) {
            return redirect(route('blogs'));
        }

        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * ブログを更新する
     * 
     * @return view
     */
    public function exeUpdate(BlogRequest $request) 
    {
        // ブログのデータを受け取る
        // $inputs = $request->all();

        // ブログを更新
        $blog = Blog::find($request->id);
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();

        return redirect(route('blogs'));
    }
    /**
     * ブログ削除
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if (empty($id)) {
            return redirect(route('blogs'));
        }

        try {
            // ブログを削除
            Blog::destroy($id);
        } catch(\Throwable $e) {
            abort(500);
        }

        return redirect(route('blogs'));
    }

}
