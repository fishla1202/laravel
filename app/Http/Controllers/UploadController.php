<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Auth;
use Image;
class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUpload() {
        return view('upload');
    }

    public function postUpload(Request $request) {
        $user = Auth::user();
        $file = $request->file('picture'); 
        // getclient...() = 維持原檔案格式 如jpg png
        $filename = uniqid($user->id."_").".".$file->getClientOriginalExtension();

        // disk決定將使用者上傳得圖片放在哪 put(檔案名稱, 檔案) File::get 將編碼還原成檔案 第三個參數設定上傳檔案是否公開
        Storage::disk('s3')->put($filename, File::get($file), 'public');

        // php artisan storage:link 將 storage的public資料夾內的檔案公開 可查看

        //$url = 儲存在s3的url
        $url = Storage::disk('s3')->url($filename);
        $user->profile_pic = $url;
        $user->save();

        //fit the image
        $thumb = Image::make($file);
        $thumb->fit(200); //(weight, height , positivon) image.intervention.io/
        $jpg = (string) $thumb->encode('jpg');//轉檔
        // PATHINFO_FILENAME只抓檔名不抓附檔名
        $thumbName = pathinfo($filename, PATHINFO_FILENAME).'-thumb.jpg';
        Storage::disk('s3')->put($thumbName, $jpg, 'public');

        return view('upload-complete')->with('filename', $filename)->with('url', $url);
    }
}
