
<form action="/create" method="post">
    <fieldset <?php if (!$checkTodayWant) echo 'disabled'; ?>>
        <legend><h2>やりたいことを記録しよう</h2></legend>
        <textarea name="want" id="want"></textarea><br>
        <input type="submit" value="記録する">
    </fieldset>
</form>
<p>記録できるのは、1日1個まで！ <?php echo $checkTodayWant ? '' : '本日はすでにやりたいことを記録しています！'; ?></p>

<h2>ユーザーステータス</h2>
<ul>
    <li>ユーザID：<?php echo $user_id; ?></li>
    <li>ユーザ名</li>
    <li>レベル</li>
    <li>経験値</li>
    <li>記入回数</li>
    <li>継続期間</li>
</ul>

<h2>やりたいこと一覧</h2>
<h3>これから達成するリスト</h3>
<ul>
    <?php foreach ($wants as $want): ?>
        <?php if ($want['achieved_want']) continue; ?>
        <li><?php echo $want['want']; ?></li>
        <p>登録日：<?php echo date('Y年m月d日', strtotime($want['created_at'])); ?></p>
        <form action="/achieve" method="post">
            <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
            <input type="submit" value="達成した！">
        </form>
        <form action="/update" method="post">
            <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
            <input type="submit" value="編集する">
        </form>
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

<h3>達成済みリスト</h3>
<ul>
    <?php foreach ($wants as $want): ?>
        <?php if (!$want['achieved_want']) continue; ?>
        <li><?php echo $want['want']; ?></li>
        <p>登録日：<?php echo date('Y年m月d日', strtotime($want['created_at'])); ?></p>
        <form action="/notAchieve" method="post">
            <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
            <input type="submit" value="未達成に戻す">
        </form>
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
