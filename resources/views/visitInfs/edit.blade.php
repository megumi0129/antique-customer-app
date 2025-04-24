<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>来店履歴の編集</title>
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
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input[type="text"],
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
        textarea {
            height: 80px;
        }
        img {
            margin-top: 8px;
            max-width: 200px;
            display: block;
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
    <h1>来店履歴の編集</h1>

    <form action="{{ route('visitInfs.update', $visit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="customer_id" value="{{ $visit->customer_id }}">

        <label>スタイリスト名</label>
        <input type="text" name="stylist_name" value="{{ old('stylist_name', $visit->stylist_name) }}" maxlength="60">

        <label>指名</label>
        <select name="shimei">
            <option value="">選択してください</option>
            <option value="1" {{ $visit->shimei == 1 ? 'selected' : '' }}>有</option>
            <option value="0" {{ $visit->shimei == 0 ? 'selected' : '' }}>無</option>
        </select>

        <label>メニュー</label>
        <input type="text" name="menu" value="{{ old('menu', $visit->menu) }}" maxlength="160">

        <label>料金</label>
        <input type="text" name="price" value="{{ old('price', $visit->price) }}" maxlength="50">

        <label>施術時間</label>
        <input type="text" name="needed_time" value="{{ old('needed_time', $visit->needed_time) }}" maxlength="5">

        <label>メモ</label>
        <textarea name="memo" maxlength="160">{{ old('memo', $visit->memo) }}</textarea>

        <label>来店日時</label>
        <input type="datetime-local" name="book_time" value="{{ old('book_time', \Carbon\Carbon::parse($visit->book_time)->format('Y-m-d\TH:i')) }}">

        <label>画像1</label><br>
        @if ($visit->file_path1)
            <img src="{{ asset($visit->file_path1) }}">
        @endif
        <input type="file" name="file_path1" accept="image/*">

        <label>画像2</label><br>
        @if ($visit->file_path2)
            <img src="{{ asset($visit->file_path2) }}">
        @endif
        <input type="file" name="file_path2" accept="image/*">

        <label>画像3</label><br>
        @if ($visit->file_path3)
            <img src="{{ asset($visit->file_path3) }}">
        @endif
        <input type="file" name="file_path3" accept="image/*">

        <button type="submit">更新する</button>
    </form>
    <form action="{{ route('visitInfs.destroy', $visit->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
    @csrf
    @method('DELETE')
    <button type="submit" style="background-color: #e53935; margin-top: 10px;">
        削除する
    </button>
</form>

    <a href="{{ route('visit.history', $visit->customer_id) }}" class="back-link">← 戻る</a>
</div>
</body>
</html>
