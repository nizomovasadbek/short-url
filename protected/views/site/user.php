Hello <?php echo $user->username; ?>
<p>
    <a href="/short">
        New
    </a><br>
    <a href="/my">
        My links
    </a>
</p>
<p>
    <br>
    <?php
        if(Yii::app()->user->role == 'admin' || Yii::app()->user->role == 'super'){
            echo '<a href="/admin">Admin panel</a>';
        }
    ?>
</p>
<p>
    <a href="/auth/logout">
        Logout
    </a>
</p>