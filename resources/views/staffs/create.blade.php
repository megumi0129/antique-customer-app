@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-md">
    <h2 class="text-xl font-semibold mb-4">新規スタッフ登録</h2>

    @if(session('password'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            スタッフが登録されました。<br>
            <strong>ログインID:</strong> {{ session('username') }}<br>
            <strong>パスワード:</strong> {{ session('password') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('staffs.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">名前</label>
            <input type="text" name="name" required class="w-full border rounded px-3 py-2" value="{{ old('name') }}">
        </div>

        <div>
            <label class="block font-medium">ログインID（英字のみ）</label>
            <input type="text" name="username" required pattern="[A-Za-z]+" class="w-full border rounded px-3 py-2" value="{{ old('username') }}">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
            登録
        </button>
    </form>
</div>
@endsection
