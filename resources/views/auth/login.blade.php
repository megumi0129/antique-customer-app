<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 360px;
            margin: 60px auto;
            padding: 25px 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #305496;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 16px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4A90E2;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #357ABD;
        }

        .error-box {
            background-color: #ffe6e6;
            color: #d8000c;
            border: 1px solid #d8000c;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        ul {
            padding-left: 20px;
            margin: 0;
        }

        @media (max-width: 400px) {
            .login-container {
                margin: 40px 16px;
                padding: 20px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>ログイン</h2>

        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <label>ユーザー名</label>
            <input type="text" name="username" required>

            <label>パスワード</label>
            <input type="password" name="password" required>

            <button type="submit">ログイン</button>
        </form>
    </div>
</body>
</html>
