<h1>
    User registration
</h1>

<div class="form">
    
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>
    
    <div class="row">
        <?php echo CHtml::activeLabel($model, 'Username'); ?>
        <?php echo CHtml::activeTextField($model, 'username'); ?>
    </div>
    
</div>