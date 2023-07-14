<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Result;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::put('nextQues', 1);
        $q = question::all()->first();
        return view('home')->with(['question' => $q]);
    }
    public function saveAnswer(Request $request)
    {
        $nextQues   = Session::get('nextQues');
        $data = Validator::make($request->all(), [
            'dbans'      => 'required',
            'ans'        => 'required',
        ]);

        $nextQues += 1;

        Session::put("nextQues", $nextQues);

        $i = 0;
        $correct_ANS = 0;
        $wrong_ANS   = 0;

        $questions = question::all();
        $userId    = Auth::user()->id;
        if ($request->dbans == $request->ans) {
            $correct_ANS = 1;
            $wrong_ANS  = 0;
        } else {
            $correct_ANS = 0;
            $wrong_ANS  = 1;
        }
        Result::updateOrCreate(
            ['user_id' => $userId],
            [
                'correct_answer' => Result::where('user_id', $userId)->sum('correct_answer') + $correct_ANS,
                'wrong_answer' => Result::where('user_id', $userId)->sum('wrong_answer') + $wrong_ANS,
            ]
        );
        foreach ($questions as $question) {
            $i++;
            if ($questions->count() < $nextQues) {
                $result = Result::where('user_id', $userId)->first();
                return view('end_test', compact('result'));
            }
            if ($i == $nextQues) {

                return view('home')->with(['question' => $question]);
            }
        }
    }
}
