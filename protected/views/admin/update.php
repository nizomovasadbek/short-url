<h1><?php echo Yii::t() . ' ' . $user->username . ' ' . Yii::t('translation', 'role'); ?></h1>
<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabel($model, Yii::t('translation', 'role')); ?>
        <?php echo CHtml::dropDownList('role', '', ['admin', 'user']); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton(Yii::t('translation', 'update')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div>