<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TweetRepository;

use App\Models\Tweet;
use App\Models\User;

class HomeController extends Controller
{
    protected $tweetRepository;
    
    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function index(Request $request)
    {
        $tweets = $this->tweetRepository->getTweets(Auth::user()->id, ['created_at', 'desc'])->get();
        $users = User::users(Auth::user()->id)->get();

        return view('index', [
            'tweets' => $tweets,
            'users' => $users
        ]);
    }
}
