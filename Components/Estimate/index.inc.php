<?php
    require_once('Models/EstimateModel.php');
    $estimate_model = new EstimateModel();
    if (array_key_exists('app', $_GET)) {
        if ($_GET['app'] != '?') {
            // echo '<script>window.location.href = "?"</script>';
        }
    }
    $estimate_choices = $estimate_model->getEstimateBy();
    $path = __DIR__;
    require_once($path."/view.inc.php");