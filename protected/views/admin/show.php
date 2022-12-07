<a href="/admin/update/<?php echo $user->id; ?>"><?php echo Yii::t('translation', 'update') . ' ' . $user->username; ?></a><br>
<a href="/admin/delete/<?php echo $user->id; ?>"><?php echo Yii::t('translation', 'delete') . ' ' . $user->username; ?></a>
<p>
    <?php
    foreach ($links as $link) {
        echo "$link->short_url -------> $link->url<br>";
    }
    ?>
</p>