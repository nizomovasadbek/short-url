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
            <?php echo $user->username; ?>
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