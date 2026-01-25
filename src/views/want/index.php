<h2>やりたいことを記録しよう</h2>
<form action="/create" method="post">
    <textarea name="want" id="want"></textarea>
    <input type="submit" value="記録する">
</form>
<p>記録できるのは、1日1個まで！</p>

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
    <?php endforeach; ?>
</ul>
