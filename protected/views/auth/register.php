<h1>
    Registration
</h1>

<div class="form">
    
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>
    
    <div class="row">
        <?php echo CHtml::activeLabel($model, 'Username'); ?>
        <?php echo CHtml::activeTextField($model, 'username'); ?>
    </div>
    
    <div class="row">
        <?php echo CHtml::activeLabel($model, 'Password'); ?>
        <?php echo CHtml::activeTextField($model, 'password'); ?>
    </div>
    
    <div class="row">
        <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
        <?php echo CHtml::activeLabel($model, 'Remember Me'); ?>
    </div>
    
    <div class="row submit">
        <?php echo CHtml::submitButton('Register'); ?>
    </div>
    
    <?php CHtml::endForm(); ?>
    
</div>