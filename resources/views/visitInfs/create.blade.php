<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>来店履歴の追加</title>
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
        input[type="datetime-local"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[maxlength], textarea[maxlength] {
            resize: none;
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
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>来店履歴の追加</h1>
    <form action="{{ route('visitInfs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="customer_id" value="{{ $customer->id }}">

        <label>スタイリスト名</label>
        <input type="text" name="stylist_name" value="{{ old('stylist_name') }}" maxlength="60">

        <label>指名</label>
        <select name="shimei">
            <option value="">選択してください</option>
            <option value="1" {{ old('shimei') == '1' ? 'selected' : '' }}>有</option>
            <option value="0" {{ old('shimei') == '0' ? 'selected' : '' }}>無</option>
        </select>

        <label>メニュー</label>
        <input type="text" name="menu" value="{{ old('menu') }}" maxlength="160">

        <label>料金</label>
        <input type="text" name="price" value="{{ old('price') }}" maxlength="50">

        <label>施術時間</label>
        <input type="text" name="needed_time" value="{{ old('needed_time') }}" maxlength="5">

        <label>メモ</label>
        <textarea name="memo" maxlength="160">{{ old('memo') }}</textarea>

        <label>来店日時</label>
        <input type="datetime-local" name="book_time" value="{{ old('book_time') }}">

        <label>画像1</label>
    <input type="file" name="file_path1" accept="image/*">
    <label>画像2</label>
    <input type="file" name="file_path2" accept="image/*">
    <label>画像3</label>
    <input type="file" name="file_path3" accept="image/*">
        <!-- <div id="imageUploadApp">
        <div id="app">
    <image-uploader></image-uploader> -->

</div>

<!-- @vite('resources/js/app.js') -->
        <button type="submit">追加</button>
    </form>

    <a href="{{ route('visit.history', $customer->id) }}" class="back-link">← 戻る</a>
    <a href="{{ route('customers.search') }}" class="back-link">← 顧客一覧（TOP）に戻る</a>
</div>
</body>
</html>
