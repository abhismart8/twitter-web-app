<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repositories\TweetRepository;

class TweetController extends Controller
{
    protected $tweetRepository;
    
    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function create(Request $request)
    {
        return $this->tweetRepository->create($request->all());
    }
}
