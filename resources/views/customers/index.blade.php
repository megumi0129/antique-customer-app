@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    <img src="{{ asset('image2.png') }}" alt="サロンロゴ" class="h-14 mx-auto mb-6">

    @if (session('success'))
        <div class="text-green-600 font-semibold text-center mb-4">{{ session('success') }}</div>
    @endif

    <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded font-bold mb-4 inline-block">＋ 顧客登録</a>

    <div class="mb-4 text-right">
        <form action="{{ route('customers.search') }}" method="GET" class="inline-flex gap-2">
            <input type="text" name="s" placeholder="名前または番号" value="{{ request('s') }}"
                class="border px-2 py-1 rounded w-40 text-sm">
            <input type="submit" value="検索"
                class="bg-blue-600 text-white text-sm px-3 py-1 rounded hover:bg-blue-700">
        </form>
    </div>

    {{-- PC用テーブル --}}
    <table class="table-desktop w-full border-collapse border text-sm hidden md:table">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">顧客番号</th>
                <th class="border p-2">名前</th>
                <th class="border p-2">電話番号</th>
                <th class="border p-2">誕生日</th>
                <th class="border p-2">メモ</th>
                <th class="border p-2">編集</th>
                <th class="border p-2">最終来店日</th>
                <th class="border p-2">履歴</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td class="border p-2">{{ $customer->salon_id }}</td>
                    <td class="border p-2">{{ $customer->name }}</td>
                    <td class="border p-2">{{ $customer->tel }}</td>
                    <td class="border p-2">{{ $customer->birth }}</td>
                    <td class="border p-2">{{ $customer->memo }}</td>
                    <td class="border p-2"><a href="{{ route('customers.edit', $customer->id) }}">✏️</a></td>
                    <td class="border p-2">{{ $customer->visits->first()?->book_time ? \Carbon\Carbon::parse($customer->visits->first()->book_time)->format('Y-m-d') : '未登録' }}</td>
                    <td class="border p-2"><a href="{{ route('visit.history', $customer->id) }}">📄</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- モバイル用カード --}}
    <div class="md:hidden">
        @foreach ($customers as $customer)
            <div class="card border rounded bg-white p-4 mb-4 shadow">
                <p><strong>顧客番号:</strong> {{ $customer->salon_id }}</p>
                <p><strong>名前:</strong> {{ $customer->name }}</p>
                <p><strong>電話番号:</strong> {{ $customer->tel }}</p>
                <p><strong>誕生日:</strong> {{ $customer->birth }}</p>
                <p><strong>メモ:</strong> {{ $customer->memo }}</p>
                <p><strong>最終来店:</strong> {{ $customer->visits->first()?->book_time ? \Carbon\Carbon::parse($customer->visits->first()->book_time)->format('Y-m-d') : '未登録' }}</p>
                <p class="mt-2">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-500 font-semibold">✏️ 顧客情報編集</a> |
                    <a href="{{ route('visit.history', $customer->id) }}" class="text-blue-500 font-semibold">📄 履歴</a>
                </p>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        {{ $customers->links() }}
    </div>
            @if(Auth::user()->role === 'owner')
            <li><a href="{{ route('staffs.index') }}">スタッフ一覧</a></li>
        @endif
</div>
@endsection



