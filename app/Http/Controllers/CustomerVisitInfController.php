<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInf;
use App\Models\CustomerVisitInf;

class CustomerVisitInfController extends Controller
{
    public function index($id)
    {
        $customer = CustomerInf::findOrFail($id);
        $visits = CustomerVisitInf::where('customer_id', $id)->orderBy('book_time', 'desc')->get();

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
            'file_path1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_path2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_path3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'book_time' => 'nullable|date',
        ]);
    //     dd($request->hasFile('file_path1'), $request->file('file_path1'));
    // dd($request);
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

        // ファイル保存処理
        for ($i = 1; $i <= 3; $i++) {
            $fileKey = 'file_path' . $i;
            if ($request->hasFile($fileKey)) {
                $path = $request->file($fileKey)->store('images', 'public'); // storage/app/public/images に保存
                $visit->$fileKey = 'storage/' . $path; // URL用パスに変換
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
            'book_time' => 'nullable|date',
        ]);

        $visit->fill($request->only([
            'stylist_name', 'shimei', 'menu', 'price', 'needed_time', 'memo', 'book_time'
        ]));
        $visit->update_time = now();

        // 画像の更新（元のファイルは残す）
        for ($i = 1; $i <= 3; $i++) {
            $fileKey = 'file_path' . $i;
            if ($request->hasFile($fileKey)) {
                $filename = now()->format('YmdHis') . "_{$i}_" . uniqid() . '.' . $request->file($fileKey)->getClientOriginalExtension();
                $path = $request->file($fileKey)->storeAs('images', $filename, 'public');
                $visit->$fileKey = 'storage/' . $path;
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
