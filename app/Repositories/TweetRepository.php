<?php

namespace App\Repositories;

use Log;
use Illuminate\Support\Str;
use App\Models\Tweet;

class TweetRepository
{
    public static function getTweets($userId, $sort=null)
    {
        $tweets = Tweet::user($userId)
        ->sorting($sort)
        ->with('tweeter');

        return $tweets;
    }

    public static function create($data)
    {
        $data['id'] = Str::uuid()->toString();
        
        $tweet = Tweet::create($data);

        Log::info("Tweet created by: ".$data['user_id']);

        return response()->json(['status' => 'success', 'data' => $tweet->refresh(),
        'message' => 'Tweeted Successfully']);
    }
}
