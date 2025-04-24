<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>来店履歴の詳細</title>
    <style>
        body { font-family: sans-serif; margin: 30px; background-color: #f9f9f9; }
        .container { background: #fff; padding: 20px; border-radius: 8px; max-width: 800px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { border-bottom: 1px solid #ccc; padding-bottom: 5px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        img { max-width: 100%; height: auto; margin-top: 10px; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #4CAF50; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h2>来店履歴の詳細</h2>
    <table>
        <tr><th>スタイリスト</th><td>{{ $visitInf->stylist_name }}</td></tr>
        <tr><th>指名</th><td>{{ $visitInf->shimei == 1 ? '有' : '無' }}</td></tr>
        <tr><th>メニュー</th><td>{{ $visitInf->menu }}</td></tr>
        <tr><th>価格</th><td>{{ $visitInf->price }}</td></tr>
        <tr><th>所要時間</th><td>{{ $visitInf->needed_time }}</td></tr>
        <tr><th>来店日時</th><td>{{ $visitInf->book_time }}</td></tr>
        <tr><th>メモ</th><td>{{ $visitInf->memo }}</td></tr>
    </table>

    <h3>来店画像</h3>
    @for ($i = 1; $i <= 3; $i++)
        @php $path = $visitInf->{'file_path' . $i}; @endphp
        @if ($path)
            <img src="{{ asset($path) }}" alt="画像{{ $i }}">
        @endif
    @endfor
    <a href="{{ route('visitInfs.edit', $visitInf->id) }}" class="btn-register">この履歴を編集する</a>
    <br>
    <a href="{{ route('visit.history', $customer->id) }}" class="back-link">← 履歴一覧に戻る</a>
</div>
</body>
</html>
