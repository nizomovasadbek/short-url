<h1>Update user role</h1>
<div class="form">
    
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>
    
    <div class="row"> <comment></comment>
        <?php echo CHtml::activeLabel($model, 'Role'); ?>
        <?php echo CHtml::dropDownList('role', '', [1=>'admin', 2=>'user']); ?>
    </div>
    
    <div class="row">
        <?php echo CHtml::submitButton('Update'); ?>
    </div>
    
    <?php echo CHtml::endForm(); ?>
    
</div>