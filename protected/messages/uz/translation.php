<?php

$models = Translation::model()->findAll();
$list = CHtml::listData($models, 'title', 'title_uz');

return $list;