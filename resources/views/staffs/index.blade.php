@extends('layouts.app') {{-- レイアウトに統一感があるなら --}}
@section('content')
@if(session('message'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('message') }}
    </div>
@endif

<div class="container mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">スタッフ一覧</h2>

    <a href="{{ route('staffs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-600">新規スタッフ登録</a>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 text-sm md:text-base">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">名前</th>
                    <th class="p-2 text-left">ログインID</th>
                    <th class="p-2 text-left">状態</th>
                    <th class="p-2 text-left">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs as $staff)
                <tr class="border-t">
                    <td class="p-2">{{ $staff->name }}</td>
                    <td class="p-2">{{ $staff->username }}</td>
                    <td class="p-2">
                        {{ $staff->active ? '有効' : '無効' }}
                    </td>
                    <td class="p-2 space-x-2">
                        <form action="{{ route('staffs.toggle', $staff->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-sm bg-yellow-400 hover:bg-yellow-500 px-2 py-1 rounded">
                                {{ $staff->active ? '無効にする' : '有効にする' }}
                            </button>
                        </form>

                        <form action="{{ route('staffs.destroy', $staff->id) }}" method="POST" class="inline" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm bg-red-500 text-white hover:bg-red-600 px-2 py-1 rounded">
                                削除
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
