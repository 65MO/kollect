<?php
$contenu = ob_get_clean();
include 'global/hdp.php';
echo $contenu;
include 'global/bdp.php';