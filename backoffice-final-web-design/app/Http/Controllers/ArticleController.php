<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    public function create_article() {
        return view('article-new',[
            'categories' => ArticleCategory::all()
        ]);
    }

    public function save_article(Request $request) {
        $user = Session::get('auth-user');

        $new_article = new Article();
        $new_article->title = trim($request->title);
        $new_article->category = $request->category;
        $new_article->picture = trim($request->picture);
        $new_article->content = trim($request->content);
        $new_article->summary = trim($request->summary);
        $new_article->author = $user->user_id;
        $new_article->save();

        return redirect()->route("article_list");
    }

    public function list_articles() {
        return view('article-list',[
            'articles' => Article::with('article_category', 'user')->get()
        ]);
    }

    public function details_article($slug) {
        $id = explode("-", $slug)[0];

        return view('article-details', [
            'article' => Article::with('article_category', 'user')->find($id)
        ]);
    }

    public function update_article($id) {

    }

    public function search(Request $request) {
        $keyword = $request->keyword;

        $query = Article::with('article_category', 'user'); 

        if (!empty(trim($keyword))) {
            $query->whereRaw('UPPER(title) LIKE ?', ['%'. strtoupper($keyword) .'%'])
                    ->orWhereRaw('UPPER(summary) LIKE ?', ['%'. strtoupper($keyword) .'%'])
                    ->orWhereRaw('UPPER(content) LIKE ?', ['%'. strtoupper($keyword) .'%'])
                    ->orWhereHas('user', function ($q) use ($keyword) {
                        $q->whereRaw('UPPER(first_name) LIKE ?', ['%'. strtoupper($keyword) .'%'])
                            ->orWhereRaw('UPPER(last_name) LIKE ?', ['%'. strtoupper($keyword) .'%']);
                    })
                    ->orWhereHas('article_category', function ($q) use ($keyword) {
                        $q->whereRaw('UPPER(category_label) LIKE ?', ['%'. strtoupper($keyword) .'%']);
                    });
        }

        return view('article-list',[
            'articles' => $query->get(),
        ]);
    }
}
