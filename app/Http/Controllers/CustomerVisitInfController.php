<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInf;
use App\Models\CustomerVisitInf;
use Illuminate\Support\Facades\Storage;
use App\Services\OracleSignatureService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class CustomerVisitInfController extends Controller
{
    public function index($id)
    {
        $customer = CustomerInf::findOrFail($id);
        $visits = CustomerVisitInf::where('customer_id', $id)->orderBy('book_time', 'desc')->paginate(40);

        return view('visitInfs.index', compact('customer', 'visits'));
    }

    public function create(CustomerInf $customer)
{
    return view('visitInfs.create', compact('customer'));
}

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customer_infs,id',
            'stylist_name' => 'nullable|string|max:60',
            'shimei' => 'nullable|integer',
            'menu' => 'nullable|string|max:160',
            'price' => 'nullable|string|max:50',
            'needed_time' => 'nullable|string|max:5',
            'memo' => 'nullable|string|max:160',
            'file_path1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'file_path2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'file_path3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'book_time' => 'nullable|date',
        ]);
    //     dd($request->hasFile('file_path1'), $request->file('file_path1'));
    // dd($request);f
        $visit = new CustomerVisitInf();

        $visit->customer_id = $request->input('customer_id');
        $visit->stylist_name = $request->input('stylist_name');
        $visit->shimei = $request->input('shimei');
        $visit->menu = $request->input('menu');
        $visit->price = $request->input('price');
        $visit->needed_time = $request->input('needed_time');
        $visit->memo = $request->input('memo');
        $visit->book_time = $request->input('book_time');
        $visit->update_time = now();

        $signatureService = new OracleSignatureService();
        $host = 'objectstorage.us-ashburn-1.oraclecloud.com';
        $namespace = 'idsate1sfsxt'; // 自分のネームスペースに変更してね！
        $bucket = 'salon-photos';

        // ファイル保存処理
        for ($i = 1; $i <= 3; $i++) {
            $fileKey = 'file_path' . $i;
            if ($request->hasFile($fileKey) && $request->file($fileKey)->isValid()) {
            $extension = $request->file($fileKey)->getClientOriginalExtension();
            $filename = now()->format('Ymd_His') . '_' . Str::random(10) . '.' . $extension;

            $objectPath = "/n/{$namespace}/b/{$bucket}/o/images/{$filename}";
            $date = gmdate('D, d M Y H:i:s T');
            $authorization = $signatureService->createAuthorizationHeader('put', $host, $objectPath, $date);

            $url = "https://{$host}{$objectPath}";

            $fileContents = file_get_contents($request->file($fileKey)->path());

            $response = Http::withHeaders([
                'Host' => $host,
                'Date' => $date,
                'Authorization' => $authorization,
                'Content-Type' => 'application/octet-stream',
            ])->withBody($fileContents, 'application/octet-stream')
              ->put($url);

            if ($response->successful()) {
                $visit->$fileKey = $url; // URLをDBに保存する
            } else {
                \Log::error('ファイル保存エラー: ' . $response->status() . ' | ' . $response->body());
            }
            }
        }
        
        $visit->save();

        return redirect()->route('visit.history', $request->customer_id)
                        ->with('success', '来店履歴を追加しました');
    }

    public function show(CustomerVisitInf $visitInf)
    {
        $customer = $visitInf->customer; // リレーションしてたら

        return view('visitInfs.show', compact('visitInf', 'customer'));
    }

    public function edit($id)
    {
        $visit = CustomerVisitInf::findOrFail($id);
        return view('visitInfs.edit', compact('visit'));
    }

    public function update(Request $request, $id)
    {
        $visit = CustomerVisitInf::findOrFail($id);

        $request->validate([
            'stylist_name' => 'nullable|string|max:60',
            'shimei' => 'nullable|integer',
            'menu' => 'nullable|string|max:160',
            'price' => 'nullable|string|max:50',
            'needed_time' => 'nullable|string|max:5',
            'memo' => 'nullable|string|max:160',
            'file_path1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'file_path2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'file_path3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'book_time' => 'nullable|date',
        ]);

        $visit->fill($request->only([
            'stylist_name', 'shimei', 'menu', 'price', 'needed_time', 'memo', 'book_time'
        ]));
        $visit->update_time = now();

        $signatureService = new OracleSignatureService();
        $host = 'objectstorage.us-ashburn-1.oraclecloud.com';
        $namespace = 'idsate1sfsxt'; // 自分のネームスペースに変更してね！
        $bucket = 'salon-photos';

        // 画像の更新（元のファイルは残す）
        for ($i = 1; $i <= 3; $i++) {
            $fileKey = 'file_path' . $i;
            if ($request->hasFile($fileKey) && $request->file($fileKey)->isValid()) {
                $extension = $request->file($fileKey)->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . Str::random(10) . '.' . $extension;
    
                $objectPath = "/n/{$namespace}/b/{$bucket}/o/images/{$filename}";
                $date = gmdate('D, d M Y H:i:s T');
                $authorization = $signatureService->createAuthorizationHeader('put', $host, $objectPath, $date);
    
                $url = "https://{$host}{$objectPath}";
    
                $fileContents = file_get_contents($request->file($fileKey)->path());
    
                $response = Http::withHeaders([
                    'Host' => $host,
                    'Date' => $date,
                    'Authorization' => $authorization,
                    'Content-Type' => 'application/octet-stream',
                ])->withBody($fileContents, 'application/octet-stream')
                  ->put($url);
    
                if ($response->successful()) {
                    $visit->$fileKey = $url; // URLをDBに保存する
                } else {
                    \Log::error('ファイル保存エラー: ' . $response->status() . ' | ' . $response->body());
                }
            }
        } 

        $visit->save();

        return redirect()->route('visit.history', $visit->customer_id)->with('success', '来店履歴を更新しました');
    }

    public function destroy($id)
    {
        $visit = CustomerVisitInf::findOrFail($id);
        $visit->delete(); // 論理削除の場合
    
        return redirect()->route('visit.history', $visit->customer_id)
                         ->with('success', '来店履歴を削除しました');
    }
}
