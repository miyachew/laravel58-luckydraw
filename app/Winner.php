<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Winner extends Model
{
    const PRIZE_TYPES = [
        'third_price_1st',
        'third_price_2nd',
        'third_price_3rd',
        'second_price_1st',
        'second_price_2nd',
        'first_prize',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'prize_type',
        'winning_number'
    ];

    /**
     * return winning number for this member
     */
    public function winnerMember(): HasOne
    {
        return $this->hasOne('App\Member', 'id', 'member_id');
    }

    public function getFirstByPrizeType(string $prizeType): ?Winner{
        return Winner::where('prize_type',$prizeType)->first();
    }

    public function getFirstByMemberId(int $memberId): ?Winner{
        return Winner::where('member_id',$memberId)->first();
    }
}