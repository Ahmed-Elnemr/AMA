<?php

namespace App\Http\Controllers\Api\Qanda;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class AnswerController extends Controller
{

    public function index()
    {

        }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());
        $Answer = new Answer();


        $Answer->answers_text = $request->answers_text;
        $Answer->question_id = $request->question_id;
        $Answer->user_id = $authUser->id;

        $Answer->save();

        return $Answer;
    }


    public function show($id)
    {

        return Answer::Where('id' ,  $id)->with('user')->with('comment')->first();
    }


    public function more(Request $request ){
        return Answer::Where('question_id' , $request->id)->with('user')->with('comment')->orderBy('id', 'DESC')->paginate(10);
    }


    public function edit(Answer $answer)
    {
        //
    }

    public function update(Request $request, Answer $answer)
    {
        //
    }


    public function destroy(Answer $answer)
    {
        //
    }
}
