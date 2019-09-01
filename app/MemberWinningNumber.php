<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class MemberWinningNumber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'winning_number'
    ];

    /**
     * return null|MemberWinningNumber
     */
    public function getFirstUserIdByWinningNumber(string $winningNumber): ?MemberWinningNumber{
       return MemberWinningNumber::where('winning_number',$winningNumber)->first();
    }

    /**
     * return null|Collection
     */
    public function getOneRandomFromNotInWinnerList(): ?MemberWinningNumber{
        return MemberWinningNumber::whereNotIn('member_id', function ($query) {
            $query->select('member_id')->from('winners');
        })
        ->selectRaw("member_winning_numbers.member_id, count(member_winning_numbers.id) as total_winning_numbers")
        ->groupBy('member_id')
        ->orderBy(DB::raw('rand()'))
        ->first();
    }

    /**
     * return null|Collection
     */
    public function getAllFromNotInWinnerList(): ?Collection{
        return MemberWinningNumber::whereNotIn('member_id', function ($query) {
            $query->select('member_id')->from('winners');
        })
        ->selectRaw("member_winning_numbers.member_id, count(member_winning_numbers.id) as total_winning_numbers")
        ->groupBy('member_id')
        ->orderBy('total_winning_numbers','desc')
        ->get();
    }
}