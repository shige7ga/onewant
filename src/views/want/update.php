<h2>編集ページ</h2>
<form action="/update/action" method="post">
    <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
    <label for="want"><p>あなたのやりたいことは何ですか？</p></label>
    <ul>
        <?php foreach ($errors as $err) : ?>
            <li><?php echo $err; ?></li>
        <?php endforeach ?>
    </ul>
    <textarea name="want" id="want"><?php echo $want['want']; ?></textarea>
    <input type="submit" value="編集する">
</form>
