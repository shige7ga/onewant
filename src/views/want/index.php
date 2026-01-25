<a href="create"><button>やりたいことはなに？</button></a>
<p>記録できるのは、1日1個だけです。</p>

<h2>ステータス</h2>
<ul>
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
    <?php endforeach; ?>
</ul>
