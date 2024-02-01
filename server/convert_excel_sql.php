
<?php

    require_once('./convert_excel_sql_models.php');
    $convert = new convert_excel_sql_models;
    $ff = $_FILES['excelFile'];
    if($ff['type']=='application/vnd.ms-excel')
    {
        $convert->insert_from_excel($ff['name']);
    }
    else
    {
        exit("Not supported");
    }
?>  