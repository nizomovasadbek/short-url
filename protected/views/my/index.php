<?php

foreach ($links as $link) {
    echo '<p>' . $link->short_url . '-------->' . $link->url . '</p>';
}
?>

<a href="/status/download/<?php echo $fileName; ?>"><?php echo Yii::t("translation", "download_excel_file"); ?></a>