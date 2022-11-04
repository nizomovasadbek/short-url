<h1>
    <?php echo Yii::t("translation", 'registration'); ?>
</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabel($model, 'Username'); ?>
        <?php echo CHtml::activeTextField($model, Yii::t('translation', 'username')); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabel($model, 'Password'); ?>
        <?php echo CHtml::activeTextField($model, Yii::t('translation', 'password')); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
        <?php echo CHtml::activeLabel($model, Yii::t('translation', 'remember_me')); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton(Yii::t('translation', 'register')); ?>
    </div>

    <?php CHtml::endForm(); ?>

</div>