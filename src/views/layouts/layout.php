<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
    <h1><a href="/">わんわんと</a></h1>
    <p>1日1個だけやりたいことを記録するアプリ</p>
    <div>
        <form action="/signup" method="post">
            <button>ユーザ登録・ログイン</button>
        </form>
    </div>
    <?php echo $content; ?>
</body>
</html>
