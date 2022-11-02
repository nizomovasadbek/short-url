<?php

foreach($users as $user) { ?>

<table>
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
</table>
    
 <?php  } ?>