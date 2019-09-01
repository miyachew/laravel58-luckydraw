<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Winner;
use App\MemberWinningNumber;

class LuckyDrawWinnerController extends Controller
{
    const SESSION_SUCCESS_MESSAGE_KEY = 'message_success';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $winners = Winner::with('winnerMember')->get()->sortBy('prize_type');
        return view('page.lucky_draw_winner.index',['winners'=>$winners]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $prizeTypes = Winner::PRIZE_TYPES;
        return view('page.lucky_draw_winner.create',['prizeTypes'=>$prizeTypes]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $request->validate([
            'prize_type' => 'required|in:'.implode(",",Winner::PRIZE_TYPES),
            'generate_randomly' => 'required|integer|in:0,1',
            'winning_number' => 'required_if:generate_randomly,0',
        ],[
            'winning_number.required_if'=>'Winning number is required when generate randomly is No'
        ]);
        
        $prizeType = $request->post('prize_type');
        $generateRandomly = $request->post('generate_randomly');
        if($generateRandomly){
            $memberWinningNumber = new MemberWinningNumber();
            if($prizeType=='first_prize'){
                //member with mosy number of winning number
                $memberWithCountWinningNumber = $memberWinningNumber->getAllFromNotInWinnerList();
                if(!$memberWithCountWinningNumber){
                     return redirect(route('lucky-draw-winner-create'))->withInput()->withErrors(['There is no more member to random from.']); 
                }
                $highestWinningNumberMembers = [];
                $max = 0;
                foreach($memberWithCountWinningNumber as $member){
                    if($max !=0 && $max > $member->total_winning_numbers){break;}
                    $highestWinningNumberMembers[] = $member->member_id;
                    $max = $member->total_winning_numbers;
                }
                //pick one from all the member with highest winning number count
                $winnerMemberKey = array_rand($highestWinningNumberMembers,1);
                $winningNumber = null;
                $memberId = $highestWinningNumberMembers[$winnerMemberKey];
            }else{
                //randomly pick
                $memberWithCountWinningNumber = $memberWinningNumber->getOneRandomFromNotInWinnerList();
                if(!$memberWithCountWinningNumber){
                     return redirect(route('lucky-draw-winner-create'))->withInput()->withErrors(['There is no more member to random from.']); 
                }
                $memberId = $memberWithCountWinningNumber->member_id;
                $winningNumber = null;
            }
        }else{
            $winningNumber = $request->post('winning_number');
            $memberWinningNumber = new MemberWinningNumber();
            $memberNumber = $memberWinningNumber->getFirstUserIdByWinningNumber($winningNumber,['prize']);
            if(!$memberNumber){
                return redirect(route('lucky-draw-winner-create'))->withInput()->withErrors(['Winning number not found.']); 
            }
            $memberId = $memberNumber->member_id;

            $winner = new Winner();
            $existsInWinner = $winner->getFirstByMemberId($memberId);
            if($existsInWinner){
                $error = sprintf('This member already won another prize. (%s)',__('app.prize_type.'.$existsInWinner->prize_type));
                return redirect(route('lucky-draw-winner-create'))
                    ->withInput()
                    ->withErrors([$error]);  
            }
        }

        $winner = new Winner();
        $existingRecord = $winner->getFirstByPrizeType($prizeType);
        if($existingRecord){
            $existingRecord->member_id = $memberId;
            $existingRecord->winning_number = $winningNumber;
            $existingRecord->save();

            Session::flash(self::SESSION_SUCCESS_MESSAGE_KEY, sprintf('Winner updated for %s',__('app.prize_type.'.$prizeType) ));

            return redirect(route('lucky-draw-winner-index')); 
        }

        Winner::create([
            'member_id'=>$memberId,
            'prize_type'=>$prizeType,
            'winning_number'=>$winningNumber
        ]);

        Session::flash(self::SESSION_SUCCESS_MESSAGE_KEY, sprintf('Winner created for %s',__('app.prize_type.'.$prizeType) ));
        return redirect(route('lucky-draw-winner-index')); 
    }
}
