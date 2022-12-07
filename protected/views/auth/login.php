<h1>
    <?php echo Yii::t('translation', 'user_registration'); ?>
</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabel($model, Yii::t("translation", 'username')); ?>
        <?php echo CHtml::activeTextField($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabel($model, Yii::t('translation', 'password')); ?>
        <?php echo CHtml::activeTextField($model, 'password'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
        <?php echo CHtml::activeLabel($model, Yii::t('translation', 'remember_me')); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton(Yii::t('translation', 'login')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div>