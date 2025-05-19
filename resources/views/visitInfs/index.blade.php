@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-5xl p-4 bg-white rounded shadow">

    @if (session('success'))
        <div class="text-green-600 text-center font-semibold mb-4">{{ session('success') }}</div>
    @endif

    <h2 class="text-lg font-semibold border-b pb-1 mb-3">顧客詳細情報</h2>
    <table class="w-full border text-sm mb-4">
        <tr><th class="bg-gray-100 p-2 w-32">顧客番号</th><td class="p-2">{{ $customer->salon_id }}</td></tr>
        <tr><th class="bg-gray-100 p-2">名前</th><td class="p-2">{{ $customer->name }}</td></tr>
        <tr><th class="bg-gray-100 p-2">電話番号</th><td class="p-2">{{ $customer->tel }}</td></tr>
        <tr><th class="bg-gray-100 p-2">電話番号2</th><td class="p-2">{{ $customer->tel2 }}</td></tr>
        <tr><th class="bg-gray-100 p-2">電話番号3</th><td class="p-2">{{ $customer->tel3 }}</td></tr>
        <tr><th class="bg-gray-100 p-2">メールアドレス</th><td class="p-2">{{ $customer->email }}</td></tr>
        <tr><th class="bg-gray-100 p-2">誕生日</th><td class="p-2">{{ $customer->birth }}</td></tr>
        <tr><th class="bg-gray-100 p-2">メモ</th><td class="p-2">{{ $customer->memo }}</td></tr>
        <tr><th class="bg-gray-100 p-2">詳細メモ</th><td class="p-2">{{ $customer->detail_memo }}</td></tr>
        <tr><th class="bg-gray-100 p-2">最終来店日</th>
            <td class="p-2">
                {{ $customer->visits->first()?->book_time ? \Carbon\Carbon::parse($customer->visits->first()->book_time)->format('Y-m-d') : '未登録' }}
            </td>
        </tr>
    </table>

    <div class="text-right mb-6">
        <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-600 font-semibold hover:underline text-sm">顧客情報編集</a>
    </div>

    <h2 class="text-lg font-semibold border-b pb-1 mb-3">来店履歴</h2>

    <a href="{{ route('visitInfs.create', $customer->id) }}"
       class="inline-block bg-blue-500 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-blue-600 mb-3">
        ＋ 履歴を追加
    </a>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">Stylist</th>
                    <th class="border px-3 py-2">指名</th>
                    <th class="border px-3 py-2">Menu</th>
                    <th class="border px-3 py-2">価格</th>
                    <th class="border px-3 py-2">所要時間</th>
                    <th class="border px-3 py-2">来店日時</th>
                    <th class="border px-3 py-2">詳細</th>
                    <th class="border px-3 py-2">編集</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visits as $visit)
                    <tr>
                        <td class="border px-2 py-1">{{ $visit->stylist_name }}</td>
                        <td class="border px-2 py-1 text-center">{{ $visit->shimei == 1 ? '有' : '無' }}</td>
                        <td class="border px-2 py-1">{{ $visit->menu }}</td>
                        <td class="border px-2 py-1 text-center">{{ $visit->price }}</td>
                        <td class="border px-2 py-1 text-center">{{ $visit->needed_time }}</td>
                        <td class="border px-2 py-1 text-center">{{ \Carbon\Carbon::parse($visit->book_time)->format('Y-m-d H:i') }}</td>
                        <td class="border px-2 py-1 text-center">
                            <a href="{{ route('visitInfs.show', $visit->id) }}" class="text-blue-500 hover:underline">詳細</a>
                        </td>
                        <td class="border px-2 py-1 text-center">
                            <a href="{{ route('visitInfs.edit', $visit->id) }}" class="text-blue-500 hover:underline">編集</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-center">
        {{ $visits->links() }}
    </div>
</div>
@endsection
