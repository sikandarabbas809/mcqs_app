<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Result;

class QuestionController extends Controller
{
    // SHOW ALL QUESTIONS LIST

    public function index()
    {
        $response = question::paginate(10);
        return view('questions', compact('response'));
    }

    // QUESTION STORE 

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'question'      => 'required',
            'opt_a'         => 'required',
            'opt_b'         => 'required',
            'opt_c'         => 'required',
            'opt_d'         => 'required',
            'correct_ans'   => 'required',
        ]);

        if ($data->fails()) {

            return $this->sendError('Validation Error.', $data->errors());
        }

        $response               = new question();
        $response->question     = $request->question;
        $response->a            = $request->opt_a;
        $response->b            = $request->opt_b;
        $response->c            = $request->opt_c;
        $response->d            = $request->opt_d;
        $response->ans          = $request->correct_ans;
        $response->user_id      =  Auth::user()->id;

        $response->save();
        return redirect()->back()->with('success', 'Question add succefully');
    }

    // QUESTION DELETE

    public function delete(Request $request)
    {

        question::where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Delete Question succefully');
    }

    // USER REPORT LIST

    public function userResult()
    {
        $response = DB::table('users')
            ->join('result', 'users.id', '=', 'result.user_id')
            ->select('users.name', 'result.correct_answer', 'result.wrong_answer')
            ->paginate(10);
        return view('user_result', compact('response'));
    }
}
