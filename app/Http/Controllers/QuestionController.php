<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // use all mathod to find all data in the database
        // use paginate(number) 可以設定一頁顯示幾個結果出來
        // use orderBy('id', 'desc') 設定結果由新到舊 依據id
        $questions = Question::orderBy('id', 'desc')->paginate(5);
        // pass the data to the view
        return view('questions.index')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("questions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 驗證 輸入格式有沒有符合 沒有符合會自動導回表單頁面
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);

        //寫入資料庫 先創建一個 question的模型 再將驗證過的用戶資料寫入
        $question = new Question();
        $question->title = $request->title;
        $question->description = $request->description;

        // 如果成功寫入 就轉去show得頁面 php artisan route:list
        if ($question->save()) {
            return redirect()->route('questions.show', $question->id);
        }else {
            return redirect()->route('questions.create');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //use modle get one record form database
        $question = Question::findOrFail($id);// find 沒收尋到記錄不會報錯 findOrFail 會報錯 其他都一樣
        //show the view pass the record to the view
        return view('questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
