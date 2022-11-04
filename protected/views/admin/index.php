<table>
    <tr>
        <th>
            <?php echo Yii::t('translation', 'username'); ?>
        </th>
        <th>
            <?php echo Yii::t('translation', 'role'); ?>
        </th>
        <th>
            <?php echo Yii::t('translation', 'last_activity'); ?>
        </th>
    </tr>
    <?php foreach ($users as $user) { ?>

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

<?php } ?>
</table>

<p>
    <a href="/admin/import"><?php echo Yii::t('translation', 'import_table'); ?></a>
</p>