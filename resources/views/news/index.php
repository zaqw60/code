
<?php
foreach ($newsList as $key => $news): ?>
<div style="border: 1px solid grey">
    <h2><a href="<?=route('news.show', ['id' => $key])?>"><?=$news['title']?></a></h2>
    <p><?=$news['description']?></p>
    <p><?=$news['created_at']->format('d-m-Y H:i')?><p><?=$news['author']?></p>
</div><br>
<?php endforeach;
