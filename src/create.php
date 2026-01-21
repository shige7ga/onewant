<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録ページ</title>
</head>
<body>
    <h1><a href="index.php">わんわんと</a></h1>
    <p>1日1個だけやりたいことを記録するアプリ</p>
    <form action="index.php" method="post">
        <label for="wantTo"><p>あなたのやりたいことは何ですか？</p></label>
        <textarea name="wantTo" id="wantTo"></textarea>
        <input type="submit" value="登録">
    </form>

</body>
</html>
