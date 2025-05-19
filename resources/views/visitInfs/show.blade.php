@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold border-b pb-2 mb-4 text-gray-700">来店履歴の詳細</h2>

    <table class="w-full border-collapse text-sm mb-4">
        <tr><th class="bg-gray-100 p-2 w-32">スタイリスト</th><td class="p-2">{{ $visitInf->stylist_name }}</td></tr>
        <tr><th class="bg-gray-100 p-2">指名</th><td class="p-2">{{ $visitInf->shimei == 1 ? '有' : '無' }}</td></tr>
        <tr><th class="bg-gray-100 p-2">メニュー</th><td class="p-2">{{ $visitInf->menu }}</td></tr>
        <tr><th class="bg-gray-100 p-2">価格</th><td class="p-2">{{ $visitInf->price }}</td></tr>
        <tr><th class="bg-gray-100 p-2">所要時間</th><td class="p-2">{{ $visitInf->needed_time }}</td></tr>
        <tr><th class="bg-gray-100 p-2">来店日時</th><td class="p-2">{{ $visitInf->book_time }}</td></tr>
        <tr><th class="bg-gray-100 p-2">メモ</th><td class="p-2">{{ $visitInf->memo }}</td></tr>
    </table>

    <h3 class="text-lg font-semibold mt-6 mb-2 text-gray-700">来店画像</h3>
    <div class="space-y-4">
        @for ($i = 1; $i <= 3; $i++)
            @php $path = $visitInf->{'file_path' . $i}; @endphp
            @if ($path)
                <img src="{{ asset($path) }}" alt="画像{{ $i }}" class="w-full rounded border">
            @endif
        @endfor
    </div>

    <div class="mt-6 space-y-3 text-center">
        <a href="{{ route('visitInfs.edit', $visitInf->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded font-semibold hover:bg-blue-600 text-sm">
            この履歴を編集する
        </a>

        <a href="{{ route('visit.history', $customer->id) }}" class="block text-green-600 text-sm hover:underline">
            ← 履歴一覧に戻る
        </a>
    </div>
</div>
@endsection
