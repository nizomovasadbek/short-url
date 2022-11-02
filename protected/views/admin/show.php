<a href="/admin/update/<?php echo $user->id; ?>">Update <?php echo $user->username; ?></a><br>
<a href="/admin/delete/<?php echo $user->id; ?>">Delete <?php echo $user->username; ?></a>
<p>
    <?php foreach($links as $link) {
        echo "$link->short_url -------> $link->url<br>";
    } ?>
</p>