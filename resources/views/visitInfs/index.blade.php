<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>顧客詳細・履歴</title>
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
            max-width: 900px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        .back-link:hover {
            color: #388e3c;
        }
        .btn-register:hover {
			background-color: #357ABD;
		}
        .btn-register {
			display: inline-block;
			padding: 8px 20px;
			background-color: #4A90E2;
			color: #fff;
			text-decoration: none;
			border-radius: 6px;
			font-weight: bold;
			font-size: 14px;
			transition: background-color 0.3s ease;
		}
    </style>
</head>
<body>
<div class="container">
    <h2>顧客詳細情報</h2>
    <table>
        <tr><th>顧客番号</th><td>{{ $customer->salon_id }}</td></tr>
        <tr><th>名前</th><td>{{ $customer->name }}</td></tr>
        <tr><th>電話番号</th><td>{{ $customer->tel }}</td></tr>
        <tr><th>電話番号2</th><td>{{ $customer->tel2 }}</td></tr>
        <tr><th>電話番号3</th><td>{{ $customer->tel3 }}</td></tr>
        <tr><th>メールアドレス</th><td>{{ $customer->email }}</td></tr>
        <tr><th>誕生日</th><td>{{ $customer->birth }}</td></tr>
        <tr><th>メモ</th><td>{{ $customer->memo }}</td></tr>
        <tr><th>詳細メモ</th><td>{{ $customer->detail_memo }}</td></tr>
        <tr><th>最終来店日</th><td>{{ $customer->visits->first()?->book_time ? \Carbon\Carbon::parse($customer->visits->first()->book_time)->format('Y-m-d') : '未登録' }}</td></tr>
        
    </table>
    <a href="{{ route('customers.edit', $customer->id) }}" style="color: #007BFF; font-weight: bold;">
    顧客情報編集
    </a>
    <h2>来店履歴</h2>
    <a href="{{ route('visitInfs.create', $customer->id) }}" class="btn-register">＋ 履歴を追加</a>
    <table>
        <thead>
            <tr>
                <th>スタイリスト</th>
                <th>指名</th>
                <th>メニュー</th>
                <th>価格</th>
                <th>所要時間</th>
                <th>来店日時</th>
                <th>詳細</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visits as $visit)
                <tr>
                    <td>{{ $visit->stylist_name }}</td>
                    <td>{{ $visit->shimei == 1 ? '有' : '無' }}</td>
                    <td>{{ $visit->menu }}</td>
                    <td>{{ $visit->price }}</td>
                    <td>{{ $visit->needed_time }}</td>
                    <td>{{ $visit->book_time }}</td>
                    <td>
                    <a href="{{ route('visitInfs.show', $visit->id) }}" style="color: #4A90E2; font-weight: bold;">詳細を見る</a>
                    </td>
                    <td>
                        <a href="{{ route('visitInfs.edit', $visit->id) }}">編集</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('customers.search') }}" class="back-link">← 戻る</a>
</div>
</body>
</html>
