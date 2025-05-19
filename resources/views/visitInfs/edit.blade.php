@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl text-center font-bold text-gray-700 mb-6">来店履歴の編集</h1>

    <form action="{{ route('visitInfs.update', $visit->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="hidden" name="customer_id" value="{{ $visit->customer_id }}">

        <div>
            <label class="block font-semibold mb-1">スタイリスト名</label>
            <input type="text" name="stylist_name" value="{{ old('stylist_name', $visit->stylist_name) }}" maxlength="60" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">指名</label>
            <select name="shimei" class="w-full border px-3 py-2 rounded">
                <option value="">選択してください</option>
                <option value="1" {{ $visit->shimei == 1 ? 'selected' : '' }}>有</option>
                <option value="0" {{ $visit->shimei == 0 ? 'selected' : '' }}>無</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">メニュー</label>
            <input type="text" name="menu" value="{{ old('menu', $visit->menu) }}" maxlength="160" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">料金</label>
            <input type="text" name="price" value="{{ old('price', $visit->price) }}" maxlength="50" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">施術時間</label>
            <input type="text" name="needed_time" value="{{ old('needed_time', $visit->needed_time) }}" maxlength="5" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">メモ</label>
            <textarea name="memo" maxlength="160" class="w-full border px-3 py-2 rounded">{{ old('memo', $visit->memo) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">来店日時</label>
            <input type="datetime-local" name="book_time" value="{{ old('book_time', \Carbon\Carbon::parse($visit->book_time)->format('Y-m-d\TH:i')) }}" required class="w-full border px-3 py-2 rounded">
        </div>

        @for ($i = 1; $i <= 3; $i++)
            @php $filePath = 'file_path' . $i; @endphp
            <div>
                <label class="block font-semibold mb-1">画像{{ $i }}</label>
                @if ($visit->$filePath)
                    <img src="{{ asset($visit->$filePath) }}" class="mb-2 border rounded">
                @endif
                <input type="file" name="{{ $filePath }}" accept="image/*" class="w-full">
            </div>
        @endfor

        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">更新する</button>
    </form>

    <form action="{{ route('visitInfs.destroy', $visit->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">削除する</button>
    </form>

    <div class="text-center mt-4 space-y-2">
        <a href="{{ route('visit.history', $visit->customer_id) }}" class="text-green-600 text-sm hover:underline block">← 戻る</a>
    </div>
</div>
@endsection
