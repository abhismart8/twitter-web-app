<?php

use App\Models\Follow;

if(!function_exists('checkIfFollow')){
    function checkIfFollow($followed_id, $follower_id){
        $follow = Follow::where([['followed_id', $followed_id], ['follower_id', $follower_id]])->first();
        if($follow){
            return true;
        }
        return false;
    }
}

if(!function_exists('getAllFollowed')){
    function getAllFollowed($userId){
        return Follow::where('follower_id', $userId)->pluck('followed_id')->toArray();
    }
}