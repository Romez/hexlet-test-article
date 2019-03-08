<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $article = new Article();
        $data = $this->validate($request, [
            'body'=>'required',
            'name'=> 'required'
        ]);

        $article->saveTicket($data);
        return redirect('/')->with('success', 'New support article has been created!');
    }

    public function index()
    {
        $articles = Article::get();

        return view('article.index',compact('articles'));
    }

    public function edit($id)
    {
        $article = Article::where('id', $id)->first();

        return view('article.edit', compact('article', 'id'));
    }

    public function update(Request $request, $id)
    {
        $article = new Article();
        $data = $this->validate($request, [
            'body'=>'required',
            'name'=> 'required'
        ]);
        $data['id'] = $id;
        $article->updateTicket($data);

        return redirect('/')->with('success', 'New support article has been updated!!');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect('/')->with('success', 'Article has been deleted!!');
    }
}
