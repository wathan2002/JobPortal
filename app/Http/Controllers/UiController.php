<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\category;
use App\Models\Comment;
use App\Models\Job;
use App\Models\Message;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UiController extends Controller
{
    public function index()
    {
        // $jobs = Job::all();
        $jobs = Job::latest()->get();
        $categories = category::all();
        $news = News::latest()->take(2)->get();

        return view('ui_panel.welcome', compact('jobs', 'categories', 'news'));

    }

    public function search(Request $request)
    {
        $searchData = $request->search_data;
        $categories = category::all();

        $jobs = Job::where('title', 'like', '%'. $searchData . '%')
        ->orWhere('description', 'like', '%'. $searchData . '%')->get();

        return view('ui_panel.welcome', compact('jobs', 'categories'));
    }

    public function search_category($id)
    {
        $categories = category::all();
        if ($id) {
            $jobs = Job::where('category_id', $id)->get();
        } else {
            $jobs = Job::all();
        }
        return view('ui_panel.welcome', compact('jobs', 'categories'));
    }

    public function profile()
    {
        $user = Auth::user();
        $messages = Message::where('employee_id', $user->id)->get();

        return view('ui_panel.employee-profile', compact('messages', 'user'));
    }

    public function news()
    {
        $news = News::all();
        $news_categories = NewsCategory::all();
        return view('ui_panel.news.index',compact('news','news_categories'));
    }

    public function news_detail($id)
    {
        $new = News::find($id);
        $comments = Comment::where('status', 'show')->where('news_id', $id)->get();
        return view('ui_panel.news.detail',compact('new', 'comments'));
    }

    public function searchNews(Request $request)
    {
        $searchData = $request->search_data;
        $news_categories = NewsCategory::all();

        $news = News::where('title', 'like', '%'. $searchData . '%')
        ->orWhere('description', 'like', '%'. $searchData . '%')->get();

        return view('ui_panel.news.index', compact('news', 'news_categories'));
    }

    public function search_news($id)
    {
        $news_categories = NewsCategory::all();
        // $news = News::where('news_category_id', $id)->get();
        if ($id) {
            $news = News::where('news_category_id', $id)->get();
        } else {
            $news = News::all();
        }
        return view('ui_panel.news.index', compact('news', 'news_categories'));
    }
}
