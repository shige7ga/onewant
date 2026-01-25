<h2>編集ページ</h2>
<form action="/update/action" method="post">
    <input type="hidden" name="id" value="<?php echo $want['id']; ?>">
    <label for="want"><p>あなたのやりたいことは何ですか？</p></label>
    <textarea name="want" id="want"><?php echo $want['want']; ?></textarea>
    <input type="submit" value="編集する">
</form>
