<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>サロン管理システム</title>
    <style>
        body {
            margin: 10px;
            padding: 10px;
            font-family: "Helvetica Neue", Arial, sans-serif;
            background-color: #f9f9f9;
        }

        h1 {
            color: #305496;
            font-size: 48px;
        }

        .container {
            width: 95%;
            max-width: 1400px;
            margin: auto;
        }

        .top-header {
            font-size: 48px;
            color: #305496;
            margin-bottom: 20px;
        }

        .nav-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .nav-table td {
            padding: 10px;
        }

        .search-box {
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            padding: 5px 10px;
            font-size: 14px;
            width: 200px;
        }

        input[type="submit"] {
            padding: 5px 20px;
            background-color: #305496;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        table.table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        table.table th,
        table.table td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: center;
        }

        table.table th {
            background-color: #f0f0f0;
        }

        a {
            color: #305496;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .edit-linkicon::after {
            content: '✏️';
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

		.btn-register:hover {
			background-color: #357ABD;
		}

    </style>
</head>
<body>
    <div class="container">
		<table style="width:100%;">
    <tr>
        <td style="vertical-align: middle;">
            <img src="{{ asset('image2.png') }}" alt="サロンロゴ" style="height: 80px; margin-right: 20px;">
        </td>
    </tr>
</table>
        <table class="nav-table">
		@if (session('success'))
			<div style="color: green; font-weight: bold; margin-bottom: 15px;">
				{{ session('success') }}
			</div>
		@endif
            <tr>
                <td>
				<a href="{{ route('customers.create') }}" class="btn-register">＋ 顧客登録</a>
                </td>
                <td>
				<form action="{{ route('customers.search') }}" method="GET" class="search-box">
					<input type="text" name="s" placeholder="名前または番号" value="{{ request('s') }}">
					<input type="submit" value="検索">
				</form>
                </td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
				<th style="width: 80px;">顧客番号</th>
            <th style="width: 120px;">名前</th>
            <th style="width: 130px;">電話番号</th>
            <th style="width: 120px;">誕生日</th>
            <th style="width: 180px;">メモ</th>
            <th style="width: 120px;">顧客情報編集</th>
            <th style="width: 120px;">最終来店日</th>
            <th style="width: 100px;">履歴</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $idx => $customer)
                    <tr>
                        <td>{{ $customer['salon_id'] }}</td>
                        <td>{{ $customer['name'] }}</td>
                        <td>{{ $customer['tel'] }}</td>
                        <td>{{ $customer['birth'] }}</td>
                        <td>{{ $customer['memo'] }}</td>
                        <td><a href="{{ route('customers.edit', $customer->id) }}" class="edit-linkicon"></a></td>
                        <td>{{ $customer->visits->first()?->book_time ? \Carbon\Carbon::parse($customer->visits->first()->book_time)->format('Y-m-d') : '未登録' }}</td>
                        <td><a href="{{ route('visit.history', $customer->id) }}" class="edit-linkicon"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
