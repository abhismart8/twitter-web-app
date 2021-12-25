<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TweetRepository;

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

        return view('index', [
            'tweets' => $tweets
        ]);
    }
}
