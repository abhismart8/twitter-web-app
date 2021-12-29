<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follower;
use App\Repositories\FollowRepository;

class FollowController extends Controller
{
    protected $followRepository;
    
    public function __construct(FollowRepository $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function create(Request $request)
    {
        $data = [
            'followed_id' => $request['followed_id'],
            'follower_id' => Auth::user()->id
        ];
        return $this->followRepository->create($data);
    }
}
