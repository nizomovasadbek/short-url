<html>
    <head>
        <title>
            <?php echo Yii::app()->name; ?>
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" >
    </head>
    <body>
        <!--header-->
        <?php echo $content; ?>
        <!--footer-->
    </body>
</html>