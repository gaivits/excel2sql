

<?php
    require_once("./get_company_models.php");
    $get_company = new get_company_models;
    $data =  $get_company->main();
    echo json_encode($data[0],1);
?>  