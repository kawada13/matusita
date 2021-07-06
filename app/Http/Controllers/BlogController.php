<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;



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

}
