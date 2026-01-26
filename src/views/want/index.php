
<form action="/create" method="post">
    <fieldset <?php if (!$checkTodayWant) echo 'disabled'; ?>>
        <legend><h2>やりたいことを記録しよう</h2></legend>
        <textarea name="want" id="want"></textarea><br>
        <input type="submit" value="記録する">
    </fieldset>
</form>
<p>記録できるのは、1日1個まで！ <?php echo $checkTodayWant ? '' : '本日はすでにやりたいことを記録しています！'; ?></p>

<h2>ステータス</h2>
<ul>
    <li>ユーザID：<?php echo $user_id; ?></li>
    <li>ユーザ名</li>
    <li>レベル</li>
    <li>経験値</li>
    <li>記入回数</li>
    <li>継続期間</li>
</ul>

<h2>やりたいこと一覧</h2>
<ul>
    <?php foreach ($wants as $want): ?>
        <li><?php echo $want['want']; ?></li>
        <p>達成状況：<?php echo $want['achieved_want'] ? '達成' : '未達成'; ?></p>
        <p>登録日：<?php echo $want['created_at']; ?></p>
        <form action="update" method="post">
            <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
            <input type="submit" value="編集する">
        </form>
        <div id="myPopover" popover>
            <p>完全にデータが消えます。本当に削除しますか？</p>
            <form action="delete" method="post">
                <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
                <input type="submit" value="本当に削除する">
            </form>
            <button popovertarget="myPopover">いいえ、削除しません</button>
        </div>
        <button popovertarget="myPopover">削除する</button>
    <?php endforeach; ?>
</ul>
