<?php

namespace App\Repositories;

use Log;
use Illuminate\Support\Str;
use App\Models\Tweet;

class TweetRepository
{
    public static function getTweets($userId, $sort=null)
    {
        // getting all the user you have followed
        $usersIdArray = getAllFollowed($userId);

        // sending current user into the array as well
        $usersIdArray[] = $userId;

        // extracting tweets based on users, and other attributes
        $tweets = Tweet::users($usersIdArray)
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
