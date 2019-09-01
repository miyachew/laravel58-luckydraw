<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * return all winning numbers for this member
     */
    public function winningNumbers(): HasMany
    {
        return $this->hasMany('App\MemberWinningNumber', 'member_id', 'id');
    }
}