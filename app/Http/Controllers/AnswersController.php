<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Auth;

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
