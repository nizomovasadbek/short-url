<?php

$models = Translation::model()->findAll();
$list = CHtml::listData($models, 'title', 'title_ru');

return $list;