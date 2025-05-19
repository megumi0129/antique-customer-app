@extends('layouts.app')

@section('content')
<div class="form-container max-w-xl mx-auto bg-white p-6 shadow rounded">
    <h1 class="text-2xl text-center text-blue-700 mb-6">顧客新規登録</h1>

    @if ($errors->any())
        <div class="text-red-600 mb-4 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('customers.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="font-bold block mb-1">顧客番号</label>
            <input type="text" name="salon_id" value="{{ old('salon_id') }}" maxlength="20" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="font-bold block mb-1">名前 <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" maxlength="60" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="font-bold block mb-1">電話番号 <span class="text-red-500">*</span></label>
            <input type="text" name="tel" value="{{ old('tel') }}" maxlength="60" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="font-bold block mb-1">電話番号2</label>
            <input type="text" name="tel2" value="{{ old('tel2') }}" maxlength="60" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="font-bold block mb-1">電話番号3</label>
            <input type="text" name="tel3" value="{{ old('tel3') }}" maxlength="60" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="font-bold block mb-1">メール</label>
            <input type="email" name="email" value="{{ old('email') }}" maxlength="255" placeholder="name@example.com" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="font-bold block mb-1">誕生日</label>
            <input type="date" name="birth" value="{{ old('birth') }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="font-bold block mb-1">メモ(20字まで)</label>
            <input type="text" name="memo" value="{{ old('memo') }}" maxlength="20" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="font-bold block mb-1">詳細メモ</label>
            <textarea name="detail_memo" rows="4" maxlength="160" class="w-full border px-3 py-2 rounded">{{ old('detail_memo') }}</textarea>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">登録</button>
    </form>
</div>
@endsection
