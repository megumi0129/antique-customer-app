@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl text-center font-bold text-gray-700 mb-6">来店履歴の追加</h1>

    @if (session('success'))
        <div class="text-green-600 text-center font-semibold mb-4">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="text-red-600 text-center font-semibold mb-4">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('visitInfs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">

        <div>
            <label class="block font-semibold mb-1">スタイリスト名</label>
            <input type="text" name="stylist_name" value="{{ old('stylist_name') }}" maxlength="60" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">指名</label>
            <select name="shimei" class="w-full border px-3 py-2 rounded">
                <option value="">選択してください</option>
                <option value="1" {{ old('shimei') == '1' ? 'selected' : '' }}>有</option>
                <option value="0" {{ old('shimei') == '0' ? 'selected' : '' }}>無</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">メニュー</label>
            <input type="text" name="menu" value="{{ old('menu') }}" maxlength="160" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">料金</label>
            <input type="text" name="price" value="{{ old('price') }}" maxlength="50" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">施術時間</label>
            <input type="text" name="needed_time" value="{{ old('needed_time') }}" maxlength="5" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">メモ</label>
            <textarea name="memo" maxlength="160" class="w-full border px-3 py-2 rounded">{{ old('memo') }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">来店日時</label>
            <input type="datetime-local" name="book_time" value="{{ old('book_time') }}" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">画像1</label>
            <input type="file" name="file_path1" accept="image/*" class="w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">画像2</label>
            <input type="file" name="file_path2" accept="image/*" class="w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">画像3</label>
            <input type="file" name="file_path3" accept="image/*" class="w-full">
        </div>

        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">追加</button>
    </form>

    <div class="text-center mt-4 space-y-2">
        <a href="{{ route('visit.history', ['customer' => $customer->id]) }}" class="text-green-600 text-sm hover:underline block">← 戻る</a>
    </div>
</div>
@endsection
