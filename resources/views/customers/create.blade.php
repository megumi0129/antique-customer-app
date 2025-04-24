<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>顧客新規登録</title>
    <style>
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 30px;
        }

        .form-container {
            max-width: 600px;
            background-color: #fff;
            padding: 25px 30px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #305496;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .form-group label {
            width: 120px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            flex: 1;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4A90E2;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-submit:hover {
            background-color: #357ABD;
        }

        .error-box {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>顧客新規登録</h1>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('customers.store') }}">
            @csrf

            <div class="form-group">
                <label>顧客番号</label>
                <input type="text" name="salon_id" value="{{ old('salon_id') }}" maxlength="20">
            </div>

            <div class="form-group">
                <label>名前</label>
                <input type="text" name="name" value="{{ old('name') }}" maxlength="60">
            </div>

            <div class="form-group">
                <label>電話番号</label>
                <input type="text" name="tel" value="{{ old('tel') }}" maxlength="60">
            </div>

            <div class="form-group">
                <label>電話番号2</label>
                <input type="text" name="tel2" value="{{ old('tel2') }}" maxlength="60">
            </div>

            <div class="form-group">
                <label>電話番号3</label>
                <input type="text" name="tel3" value="{{ old('tel3') }}" maxlength="60">
            </div>
            <div class="form-group">
                <label>メール</label>
                <input type="email" name="email" value="{{ old('email') }}" maxlength="255" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label>誕生日</label>
                <input type="date" name="birth" value="{{ old('birth') }}">
            </div>

            <div class="form-group">
                <label>メモ(20字まで)</label>
                <input type="text" name="memo" value="{{ old('memo') }}" maxlength="20">
            </div>

            <div class="form-group" style="flex-direction: column; align-items: flex-start;">
                <label for="detail_memo" style="margin-bottom: 5px;">詳細メモ</label>
                <textarea name="detail_memo" id="detail_memo" rows="4" maxlength="160"
                        style="width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px;">{{ old('detail_memo') }}</textarea>
            </div>
            <button type="submit" class="btn-submit">登録</button>
        </form>
        <a href="{{ route('customers.search') }}" class="back-link">← 初めの画面に戻る</a>
    </div>
</body>
</html>
