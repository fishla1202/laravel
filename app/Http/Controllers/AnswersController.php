<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Auth;
use App\Notifications\NewAnswerSubmitted;
use Carbon\Carbon;

class AnswersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:15',
            'question_id' => 'required|integer'
        ]);

        $answer = new Answer();
        $answer->content = $request->content;
        $answer->user()->associate(Auth::id());

        $question = Question::findOrFail($request->question_id);
        //將外來鍵關聯
        $question->answers()->save($answer);
        // notify setup 當有人提出答案時寄信給問題的擁有者 user model has user email 所以有laravel會知道要寄給誰 
        // NewAnswerSubmitted 傳入參數 答案,問題, 提出答案的user name 
        // notitications 延遲很嚴重！！！！ google尋找解決方案！
        
        $question->user->notify(new NewAnswerSubmitted($answer, $question, Auth::user()->name));

        //儲存成功導回頁面
        return redirect()->route('questions.show', $request->question_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer = Answer::findOrFail($id);
        // 如果使用者id 和 問題的使用者id不符合 跳出權限拒絕403頁面
        if ($answer->user->id != Auth::id()) {
            return abort(403);
        }
        return view('answers.edit')->with('answer', $answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $answer = Answer::findOrFail($id);
        $answer->content = $request->content;

        $answer->save();

        return redirect()->route('questions.show', $answer->question->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
