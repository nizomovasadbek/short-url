<table>
    <tr>
        <th>
            Username
        </th>
        <th>
            Role
        </th>
        <th>
            Last Activity
        </th>
    </tr>
<?php

foreach($users as $user) { ?>

    <tr>
        <th>
            <a href="/admin/show/<?php echo $user->id; ?>"><?php echo $user->username; ?></a>
        </th>
        <th>
            <?php echo $user->role; ?>
        </th>
        <th>
            <?php echo $user->last_activity; ?>
        </th>
    </tr>
    
 <?php  } ?>
</table>

<p>
    <a href="/admin/import">Import table</a>
</p>