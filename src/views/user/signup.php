<form action="/signup/action" method="post">
    <div>
        <label for="username">ユーザ名</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" required minlength="8" maxlength="20">
    </div>
    <button>ユーザ登録</button>
</form>
<form action="" method="post">
    <button>ログイン</button>
</form>
