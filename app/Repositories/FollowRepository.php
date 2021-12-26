<?php

namespace App\Repositories;

use Log;
use Illuminate\Support\Str;
use App\Models\Follow;
use Throwable;

class FollowRepository
{
    public static function create($data)
    {
        $follow = Follow::where([['followed_id', $data['followed_id']], ['follower_id', $data['follower_id']]]);
        if(!($follow->first())){

            // if not already following
            try {
                $follow = Follow::create($data);
                Log::info($data['followed_id']." followed by ".$data['follower_id']." successfull");
                return response()->json(['status' => 'success', 'data' => $follow->refresh(),
                'message' => 'User Followed Successfully', 'key' => 'Unfollow']);
            } catch(Throwable $e) {
                Log::info($data['followed_id']." followed by ".$data['follower_id']." failed with ".$e->getMessage());
                return response()->json(['status' => 'failed', 'message' => 'User Follow Failed']);
            }
        }else{

            // if already following
            try {
                $follow->delete();
                Log::info($data['followed_id']." followed by ".$data['follower_id']." deletion successfull");
                return response()->json(['status' => 'success', 
                'message' => 'User Unfollowed Successfully', 'key' => 'Follow']);
            } catch(Throwable $e) {
                Log::info($data['followed_id']." followed by ".$data['follower_id']." deletion failed with ".$e->getMessage());
                return response()->json(['status' => 'failed', 'message' => 'User Follow Failed']);
            }

        }
    }
}
