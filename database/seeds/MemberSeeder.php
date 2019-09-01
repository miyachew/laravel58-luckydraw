<?php

use Illuminate\Database\Seeder;
use App\Member;
use App\MemberWinningNumber;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArr = [
            'John'=>["2839","2993","9931","0931","9322"],
            'Carol'=>["1234","3404"],
            'Kenny'=>["5678", "3939"],
            'Jason'=>["9012","3838","4738"],
            'Sean'=>["0000"],
            'Lisa'=>["3748","9393","3782","8301","0138"]
        ];

        foreach($dataArr as $name=>$data){
            $member = new Member();
            $member->name = $name;
            $member->save();

            $memberWinningNumber = new MemberWinningNumber();
            $toInsertArr = [];
            foreach($data as $number){
                $toInsertArr[] = [
                    'member_id'=>$member->id,
                    'winning_number'=>$number
                ];
            }
            MemberWinningNumber::insert($toInsertArr);
        }
    }
}
