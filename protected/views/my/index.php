<?php

foreach ($links as $link) {
    echo '<p>' . $link->short_url . '-------->' . $link->url . '</p>';
}
?>