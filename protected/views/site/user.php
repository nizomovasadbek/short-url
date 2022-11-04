Hello <?php echo $user->username; ?>
<p>
    <a href="/short">
        <?php echo Yii::t("translation", "new"); ?>
    </a><br>
    <a href="/my">
        <?php echo Yii::t("translation", "my_links"); ?>
    </a>
</p>
<p>
    <br>
    <?php
        if(Yii::app()->user->role == 'admin' || Yii::app()->user->role == 'super'){
            echo '<a href="/admin">' . echo Yii::t("translation", 'admin_panel') . '</a>';
        }
    ?>
</p>
<p>
    <a href="/auth/logout">
        <?php echo Yii::t("translation", "logout"); ?>
    </a>
</p>