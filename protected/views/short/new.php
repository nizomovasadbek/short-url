<h1>
    Create a new short link
</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabel($model, 'URL'); ?>
        <?php echo CHtml::activeTextField($model, 'url'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::submitButton('Create'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div>