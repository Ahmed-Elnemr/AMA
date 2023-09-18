<?php
namespace App\Http\Controllers\Api\Qanda;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Api\Controller;
class QuestionController extends Controller
{

    public function index()
    {

       return Question::with('user')->withCount(['answers'])->orderBy('id' , "DESC")->paginate(5);

    }


    public function create()
    {
    }


    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());
        $question = new Question();
        $question->the_questions = $request->q;
        $question->user_id = $authUser->id;
        if($authUser->section !=  null ){
                $question->questionscol = $authUser->section ;
        }

        $question->save();

        return $question;
    }


    public function show( $id)
    {
        return Question::where("id" , $id)->with('user')->with('answers')->withCount(['answers'])->first();
    }


    public function edit(Question $question)
    {

    }


    public function update(Request $request, Question $question)
    {

    }


    public function destroy(Question $question)
    {

    }
}
