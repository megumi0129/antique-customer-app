@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold text-center text-gray-700 mb-6">顧客情報編集</h1>

    @if (session('success'))
        <div class="text-green-600 font-semibold text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">顧客番号</label>
            <input type="text" name="salon_id" value="{{ old('salon_id', $customer->salon_id) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">名前 <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}" maxlength="60" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">電話番号 <span class="text-red-500">*</span></label>
            <input type="text" name="tel" value="{{ old('tel', $customer->tel) }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">電話番号２</label>
            <input type="text" name="tel2" value="{{ old('tel2', $customer->tel2) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">電話番号３</label>
            <input type="text" name="tel3" value="{{ old('tel3', $customer->tel3) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">誕生日</label>
            <input type="date" name="birth" value="{{ old('birth', $customer->birth) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">メールアドレス</label>
            <input type="email" name="email" value="{{ old('email', $customer->email) }}" maxlength="100" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">メモ</label>
            <input type="text" name="memo" value="{{ old('memo', $customer->memo) }}" maxlength="20" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">詳細メモ</label>
            <textarea name="detail_memo" maxlength="160" rows="4" class="w-full border rounded px-3 py-2">{{ old('detail_memo', $customer->detail_memo) }}</textarea>
        </div>

        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">更新</button>
    </form>

    <div class="text-center mt-4 space-y-2">
        <a href="{{ route('visit.history', $customer->id) }}" class="text-green-600 text-sm hover:underline block">← 顧客詳細情報に戻る</a>
    </div>
</div>
@endsection
