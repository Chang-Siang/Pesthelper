<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\GetHelper;
use Carbon;

class RecognitionController extends Controller
{

    // /* 影像辨識模組測試區塊 */
    // public function imageUpload()
    // {
    //     return view('imageUpload');
    // }

    // public function imageUploadPost()
    // {
    //     request()->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);
    //     $imageName = time() . '.' . request()->image->getClientOriginalExtension();
    //     request()->image->move(public_path('pestimg'), $imageName);
    //     return back()
    //         ->with('image', $imageName);
    // }

    /* 影像上傳及轉檔 base64 -> jpeg */
    public function ImgUploadBase64(Request $request)
    {
        $base64_image_content = $request->userImg;

        // 匹配出圖片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
            $type = $result[2];
            $path = "upload/";
            if (!file_exists($path)) {
            // 檢查是否有該資料夾，如果没有就創建，並給予最高寫入權限
                mkdir($path, 0700);
            }
            // new_file = 新檔案名稱
            $new_file = $path . time() . ".{$type}";
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
                echo $new_file;
            } else {
                echo '保存失敗';
            }
        }
    }

    /* 影像辨識 */
    public function PestRecognition(Request $request)
    {
        $userImg = $request->userImg;
        // $userImg = "upload/1543225997.jpeg"; /* 測試假路徑 */
        // return $userImg;

        $command = 'python3.6 predict.py ' . $userImg;
        $output = shell_exec($command);
        $output = str_replace(PHP_EOL, '', $output);
        $output = explode(',', $output);
        $outputCount = count($output);
        if ($output[0] != "") {
            for ($i = 0; $i < $outputCount / 2; $i++) {
                $array[$i] = [
                    'score' => $output[$i * 2],
                    'display_name' => $output[$i * 2 + 1]
                ];

            }

            $display = array_pluck($array, 'display_name');
            $score = array_pluck($array, 'score');

            for ($j = 0; $j < $outputCount / 2; $j++) {
                $num = DB::table('chart')->where('scientificName', 'like', $display[$j] . '%')->value('pestNum');
                $pest[$j] = ['num' => $num, 'score' => $score[$j]];
            }
            /* Cloud AutoML vision API 回傳值的數量 */
            $visionResultCount = count($pest);
            if ($visionResultCount == 1 && $pest[0] == null) {
                $pest = DB::table('chart')->whereIn('name_en', $display)->pluck('pestNum');
            }

            $recognition = DB::table('pestlist')->whereIn('num', $pest)->get();
            // 資料重編碼
            $recognition = json_decode($recognition);

            // dd($results);
            return view('site/recognitionsuccess', compact('recognition', 'pest'));


        } else {
            // dd('error');
            return view('site/recognitionfail', compact('userImg'));
        }
    }

    /* 影像辨識 with 前端假資料版本 */
    public function PestRecognitionTest(Request $request)
    {
        $userImg = $request->userImg;

        /* pestCount's fakedata */
        $visionResultCount = 2;

        /* recognition's fakedata */
        $recognition = [
            [
                "num" => "A001",
                "name" => " 小綠葉蟬",
                "scientificName" => "Empoasca Flavescens",
                "categoryNum" => "A1001",
                "category" => "半翅目",
                "habit" => "小綠葉蟬一年發生14個世代。卵期平均11.4天，孵化後經5次脫皮而羽化為成蟲，若蟲期平均31.1天，成蟲期雌蟲平均為35.4天，雄蟲平均為25.9天。一隻雌蟲一生最多可產卵粒150粒，平均為30粒。",
                "img" => "Link:somewhere"
            ], [
                "num" => "A021",
                "name" => "大蟋蟀",
                "scientificName" => "Brachytrupes portentosus",
                "categoryNum" => "A1002",
                "category" => "蟋蟀目",
                "habit" => "",
                "img" => "Link:somewhere"
            ]
        ];
        $recognition = json_encode($recognition);
        $recognition = json_decode($recognition);

        /* pest's fakedata */
        $pest = [
            [
                "num" => "A001",
                "score" => "0.9815605878829956"
            ], [
                "num" => null,
                "score" => "0.9915605878829956"
            ]
        ];

        // $results = array('pestCount' => $pestCount, 'recognition' => $recognition, 'pest' => $pest);
        // dd($results);
        return view('site/recognitionsuccess', compact('recognition', 'pest'));


        /* 辨識失敗測試 */
        // return view('site/recognitionfail', compact('userImg'));
    }


}
