<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInf;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * 画面表示: 顧客一覧画面
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->input('s');
        $query = CustomerInf::query();

        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('salon_id', 'like', "%{$keyword}%")
                  ->orWhere('tel', 'like', "%{$keyword}%")
                  ->orWhere('tel2', 'like', "%{$keyword}%")
                  ->orWhere('tel3', 'like', "%{$keyword}%");
            });
        }
        $customers = $query->leftJoin(DB::raw('(SELECT customer_id, MAX(book_time) as latest_visit FROM customer_visit_infs GROUP BY customer_id) as visits'), 'customer_infs.id', '=', 'visits.customer_id')
        ->select('customer_infs.*', 'visits.latest_visit')
        ->orderByDesc('visits.latest_visit')
        ->paginate(40);

        // return view('welcome');
        return view('customers.index', compact('customers'));
    }

    /**
     * 画面表示: 顧客新規登録
     * @param  \Illuminate\Http\Request  $request
     */
    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'salon_id'     => 'nullable|string|max:20',
            'name'         => 'nullable|string|max:60',
            'tel'          => 'nullable|string|max:160',
            'tel2'         => 'nullable|string|max:160',
            'tel3'         => 'nullable|string|max:160',
            'email'        => 'nullable|email|max:160',
            'birth'        => 'nullable|date',
            'memo'         => 'nullable|string|max:20',
            'detail_memo'  => 'nullable|string|max:255',
            'update_time'  => 'nullable|date',
            'lastdate'     => 'nullable|date',
        ]);
    
        $validated['update_time'] = now(); // 自動で現在時刻を入れておく
    
        $customer = CustomerInf::create($validated);
        return redirect()->route('visit.history', $customer->id)->with('success', '顧客を登録しました！');
        // return redirect()->route('customers.search')->with('success', '顧客を登録しました！');
    }

    public function edit($id)
    {
        $customer = CustomerInf::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'salon_id'     => 'nullable|string|max:20',
            'name'         => 'nullable|string|max:60',
            'tel'          => 'nullable|string|max:160',
            'tel2'         => 'nullable|string|max:160',
            'tel3'         => 'nullable|string|max:160',
            'birth'        => 'nullable|date',
            'email'        => 'nullable|email|max:100',
            'memo'         => 'nullable|string|max:20',
            'detail_memo'  => 'nullable|string|max:255',
        ]);

        $customer = CustomerInf::findOrFail($id);
        $customer->update([
            'salon_id'     => $request->input('salon_id'),
            'name'         => $request->input('name'),
            'tel'          => $request->input('tel'),
            'tel2'         => $request->input('tel2'),
            'tel3'         => $request->input('tel3'),
            'birth'        => $request->input('birth'),
            'email'        => $request->input('email'),
            'memo'         => $request->input('memo'),
            'detail_memo'  => $request->input('detail_memo'),
            'update_time'  => now(),
        ]);

        return redirect()->route('customers.edit', $id)->with('success', '更新しました');
    }

}
