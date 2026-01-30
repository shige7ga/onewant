
<?php if (!isset($_SESSION['user_id'])) : ?>
    <div>
        <form action="/signup" method="post">
            <button>ユーザ登録・ログイン</button>
        </form>
    </div>
<?php endif ?>
<form action="/create" method="post">
    <fieldset <?php if (!$checkTodayWant) echo 'disabled'; ?>>
        <legend><h2>やりたいことを記録しよう</h2></legend>
        <ul>
            <?php foreach ($errors as $err) : ?>
                <li><?php echo $err; ?></li>
            <?php endforeach ?>
        </ul>
        <textarea name="want" id="want"></textarea><br>
        <input type="submit" value="記録する">
    </fieldset>
</form>
<p>記録できるのは、1日1個まで！ <?php echo $checkTodayWant ? '' : '本日はすでにやりたいことを記録しています！'; ?></p>

<h2>ユーザーステータス</h2>
<ul>
    <li>ユーザID：<?php echo $user_id; ?></li>
    <li>ユーザ名：</li>
    <li>レベル：</li>
    <li>経験値：</li>
    <li>やりたいことの数：</li>
    <li>達成したやりたいこと：</li>
    <li>現在継続期間：</li>
    <li>最大継続期間：</li>
</ul>

<h2>やりたいこと一覧</h2>
<h3>これから達成するリスト</h3>
<ul>
    <?php foreach ($wants as $want): ?>
        <li><?php echo $want['want']; ?></li>
        <p>登録日：<?php echo date('Y年m月d日', strtotime($want['created_at'])); ?></p>
        <p>達成状況：<?php echo $want['achieved_want'] ? '達成' : '未達成'; ?></p>
        <form action="/switchAchievedWant" method="post">
            <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
            <input type="submit" value="<?php echo $want['achieved_want'] ? '未達成に戻す' : '達成した！'; ?>">
        </form>
        <?php if (!$want['achieved_want']) : ?>
            <form action="/update" method="post">
                <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
                <input type="submit" value="編集する">
            </form>
        <?php endif ?>
        <button popovertarget="myPopover">削除する</button>
        <div id="myPopover" popover>
            <p>完全にデータが消えます。本当に削除しますか？</p>
            <form action="/delete" method="post">
                <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
                <input type="submit" value="本当に削除する">
            </form>
            <button popovertarget="myPopover">いいえ、削除しません</button>
        </div>
    <?php endforeach; ?>
</ul>
