
<?php
require_once("../connections.php");
class get_company_models extends connections
{

    public function main()
    {
        $conn = $this->oracleMyConn();
        $sql = "SELECT min(SI_DESC_ENG) as cc FROM TSTTEST.si_mstr";
        $result = $conn->prepare($sql);
        $result->execute();

        $arr = [];
        $x = 0;
        while ($obj = $result->fetch(PDO::FETCH_ASSOC)) {
            $arr[$x] = $obj;
            $x++;
        }

        return $arr;
    }
}


?>  