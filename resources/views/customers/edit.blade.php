<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>顧客情報編集</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 30px;
            background-color: #f9f9f9;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 80px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #45a049;
        }
        .success {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>顧客情報編集</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>顧客番号</label>
        <input type="text" name="salon_id" value="{{ old('salon_id', $customer->salon_id) }}">

        <label>名前</label>
        <input type="text" name="name" value="{{ old('name', $customer->name) }}" maxlength="60">

        <label>電話番号</label>
        <input type="text" name="tel" value="{{ old('tel', $customer->tel) }}">

        <label>電話番号２</label>
        <input type="text" name="tel2" value="{{ old('tel2', $customer->tel2) }}">

        <label>電話番号３</label>
        <input type="text" name="tel3" value="{{ old('tel3', $customer->tel3) }}">

        <label>誕生日</label>
        <input type="date" name="birth" value="{{ old('birth', $customer->birth) }}">

        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email', $customer->email) }}" maxlength="100">

        <label>メモ</label>
        <input type="text" name="memo" value="{{ old('memo', $customer->memo) }}" maxlength="20">

        <label>詳細メモ</label>
        <textarea name="detail_memo" maxlength="160">{{ old('detail_memo', $customer->detail_memo) }}</textarea>
        <button type="submit">更新</button>
    </form>

    <a href="{{ route('visit.history', $customer->id) }}" class="back-link">← 顧客詳細情報に戻る</a>
    <br>
    <a href="{{ route('customers.search') }}" class="back-link">← 初めの画面に戻る</a>
</div>
</body>
</html>