<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'followers';

    protected $hidden = [
        //
    ];

    /**
     *
     * fillable properties
     */
    protected $fillable = [
        'follower_id ',
        'followed_id'
    ];

    protected $casts = [
        //
    ];
}
