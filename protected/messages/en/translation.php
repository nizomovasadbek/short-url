<?php

$models = Translation::model()->findAll();
$list = CHtml::listData($models, 'title', 'title_en');

return $list;
