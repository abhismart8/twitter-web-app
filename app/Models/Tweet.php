<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tweets';

    protected $hidden = [
        //
    ];

    /**
     *
     * fillable properties
     */
    protected $fillable = [
        'id',
        'user_id',
        'content'
    ];

    protected $casts = [
        //
    ];

    public function tweeter()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function scopeUser($query, $userId)
    {
        return $query->where('user_id',$userId);
    }

    public function scopeSorting($query, $sort)
    {
        if($sort){
            if($sort[1]=='asc'){
                return $query->orderBy($sort[0]);
            }else{
                return $query->orderByDesc($sort[0]);
            }
        }else{
            return $query;
        }
    }
}
