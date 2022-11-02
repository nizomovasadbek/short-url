<h1>Update user role</h1>
<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabel($model, 'Role'); ?>
        <?php echo CHtml::dropDownList('role', '', ['admin', 'user']); ?>
    </div>

    <div class="row">
        <?php echo CHtml::submitButton('Update'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div>