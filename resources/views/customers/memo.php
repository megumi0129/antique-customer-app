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
        <div class="top-header">サロン管理システム</div>

        <table class="nav-table">
            <tr>
                <td>
				<a href="customer.create.php" class="btn-register">＋ 顧客登録</a>
				<!-- <a href="{{ route('customer.create') }}" class="btn-register">＋ 顧客登録</a> -->
                </td>
                <td>
                    <form id="form1" action="salon.php" method="get" class="search-box">
                        <input name="s" type="text" placeholder="名前または番号" />
                        <input type="submit" value="検索" />
                    </form>
                </td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>顧客番号</th>
                    <th>名前</th>
                    <th>電話番号</th>
                    <th>誕生日</th>
                    <th>メモ</th>
                    <th>顧客情報編集</th>
                    <th>最終来店日</th>
                    <th>詳細</th>
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
                        <!-- <td><a href="{{ route('customer.edit', ['id' => $customer['id']]) }}" class="edit-linkicon"></a></td> -->
                        <td><a href="aa.php" class="edit-linkicon"></a></td>
                        <td>{{ $customer['lastdate'] }}</td>
                        <td><a href="{{ route('customer.detail', ['id' => $customer['id']]) }}" class="edit-linkicon"></a></td>
                        <td><a href="{{ route('customer.detail', ['id' => $customer['id']]) }}" class="edit-linkicon"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
