<?php
require_once("../vendor/autoload.php");
require_once("../connections.php");


use PhpOffice\PhpSpreadsheet\IOFactory;

class convert_excel_sql_models extends connections
{

    function insert_from_excel($files)
    {
        $conn = $this->oracleMyConn();

        // Specify the path to your Excel file
        $excelFilePath = "../documents/{$files}";

        // Load the Excel file
        $spreadsheet = IOFactory::load($excelFilePath);

        // Get the first sheet in the Excel file
        $sheet = $spreadsheet->getActiveSheet();

        // Get the highest column and row numbers referenced in the worksheet
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $prepare_data = [];
        // Iterate through each row of the sheet
        for ($row = 1; $row <= $highestRow; $row++) {
            // Iterate through each column of the row
            for ($col = 'A'; $col <= $highestColumn; $col++) {
                // Get the value in the current cell
                $cellValue = $sheet->getCell($col . $row)->getValue();

                // Do something with the cell value, e.g., print it
                //echo "Row $row, Column $col: $cellValue\n";
                if ($col == 'A') {
                    $new_name_col = 'PC_LIST';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'B') {
                    $new_name_col = 'PC_PART';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'G') {
                    $new_name_col = 'PC_UM';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'H') {
                    $new_name_col = 'PC_MIN_PRICE';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'I') {
                    $new_name_col = 'PC_MAX_PRICE##1';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'J') {
                    $new_name_col = 'PC_MAX_PRICE##2';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'K') {
                    $new_name_col = 'PC_MAX_PRICE##3';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'L') {
                    $new_name_col = 'PC_MAX_PRICE##4';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'M') {
                    $new_name_col = 'PC_MAX_PRICE##5';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'N') {
                    $new_name_col = 'PC_MAX_PRICE##6';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'O') {
                    $new_name_col = 'PC_START';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'P') {
                    $new_name_col = 'PC_EXPIRE';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
            }
        }
    
        for ($i = 2; $i < count($prepare_data); $i++) {
            
            $PC_LIST = $prepare_data[$i]['PC_LIST'];
            $PC_PART = $prepare_data[$i]['PC_PART'];
            $PC_UM = $prepare_data[$i]['PC_UM'];
            $PC_START = strtotime($prepare_data[$i]['PC_START']) || '09-06-2024';
            $PC_EXPIRE = strtotime($prepare_data[$i]['PC_EXPIRE']) || 'now+25 years';
            $PC_MIN_PRICE = $prepare_data[$i]['PC_MIN_PRICE'];
            $PC_MAX_PRICE_1 = $prepare_data[$i]['PC_MAX_PRICE##1'];
            $PC_MAX_PRICE_2 = $prepare_data[$i]['PC_MAX_PRICE##2'];
            $PC_MAX_PRICE_3 = $prepare_data[$i]['PC_MAX_PRICE##3'];
            $PC_MAX_PRICE_4 = $prepare_data[$i]['PC_MAX_PRICE##4'];
            $PC_MAX_PRICE_5 = $prepare_data[$i]['PC_MAX_PRICE##5'];
            $PC_MAX_PRICE_6 = $prepare_data[$i]['PC_MAX_PRICE##6'];
            $sql = 'INSERT INTO TSTTEST.PC_MSTR ("U##PC_LIST",
         PC_LIST, 
         "U##PC_PROD_LINE", 
         PC_PROD_LINE, 
         "U##PC_PART", 
         PC_PART, 
         "U##PC_UM", 
         PC_UM, 
         PC_START,
         PC_EXPIRE, 
         PC_AMT_TYPE, 
         PC__QAD02, 
         "PC_MIN_QTY##1", 
         "PC_MIN_QTY##2", 
         "PC_MIN_QTY##3", 
         "PC_MIN_QTY##4", 
         "PC_MIN_QTY##5", 
         "PC_MIN_QTY##6", 
         "PC_MIN_QTY##7", 
         "PC_MIN_QTY##8", 
         "PC_MIN_QTY##9", 
         "PC_MIN_QTY##10", 
         "PC_MIN_QTY##11", 
         "PC_MIN_QTY##12", 
         "PC_MIN_QTY##13", 
         "PC_MIN_QTY##14", 
         "PC_MIN_QTY##15", 
         "PC_AMT##1", 
         "PC_AMT##2", 
         "PC_AMT##3", 
         "PC_AMT##4", 
         "PC_AMT##5", 
         "PC_AMT##6", 
         "PC_AMT##7", 
         "PC_AMT##8", 
         "PC_AMT##9", 
         "PC_AMT##10", 
         "PC_AMT##11", 
         "PC_AMT##12", 
         "PC_AMT##13", 
         "PC_AMT##14", 
         "PC_AMT##15", 
         "U##PC_CURR", 
         PC_CURR, 
         PC_TAX_IN, 
         PC__QAD01, 
         PC_USER1, 
         PC_USER2, 
         PC_MOD_DATE, 
         PC_USERID, 
         PC_MIN_PRICE, 
         "PC_MAX_PRICE##1", 
         "PC_MAX_PRICE##2", 
         "PC_MAX_PRICE##3", 
         "PC_MAX_PRICE##4", 
         "PC_MAX_PRICE##5", 
         "PC_MAX_PRICE##6", 
         "PC_MAX_PRICE##7", 
         "PC_MAX_PRICE##8", 
         "PC_MAX_PRICE##9", 
         "PC_MAX_PRICE##10", 
         PROGRESS_RECID, 
         PC_COMM_SALE, 
         PC_COMM_MGR) VALUES(NULL,:PC_LIST, NULL, NULL, NULL, :PC_PART, NULL, :PC_UM, :PC_START, :PC_EXPIRE, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, :PC_MIN_PRICE, :PC_MAX_PRICE_1, :PC_MAX_PRICE_2, :PC_MAX_PRICE_3, :PC_MAX_PRICE_4, :PC_MAX_PRICE_5, :PC_MAX_PRICE_6, NULL, NULL, NULL, NULL, NULL, NULL, NULL)';



            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':PC_LIST', $PC_LIST,PDO::PARAM_STR);
            $stmt->bindParam(':PC_PART', $PC_PART,PDO::PARAM_STR);
            $stmt->bindParam(':PC_UM', $PC_UM,PDO::PARAM_STR);
            $stmt->bindParam(':PC_START', $PC_START || strtotime('06-09-2023'),PDO::PARAM_STR);
            $stmt->bindParam(':PC_EXPIRE', $PC_EXPIRE || strtotime('now+25 years'),PDO::PARAM_STR);
            $stmt->bindParam(':PC_MIN_PRICE', $PC_MIN_PRICE,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_1', $PC_MAX_PRICE_1,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_2', $PC_MAX_PRICE_2,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_3', $PC_MAX_PRICE_3,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_4', $PC_MAX_PRICE_4,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_5', $PC_MAX_PRICE_5,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_6', $PC_MAX_PRICE_6,PDO::PARAM_STR);
            try
            {
                $stmt->execute();
            }
            catch (PDOException $e)
            {
                echo $e;
            }
        }
    }
}
// for($i = 2 ; $i<count($prepare_data);$i++)
//         {
            
//             $sql = 'INSERT INTO TSTTEST.PC_MSTR
//             (
//             "PC_LIST",
//             "PC_PART",
//             "PC_UM",
//             "PC_START",
//             "PC_EXPIRE",
//             "PC_MIN_PRICE",
//             "PC_MAX_PRICE##1",
//             "PC_MAX_PRICE##2",
//             "PC_MAX_PRICE##3",
//             "PC_MAX_PRICE##4",
//             "PC_MAX_PRICE##5",
//             "PC_MAX_PRICE##6"
//             )

//             VALUES 
//             (
//                 :PC_LIST,
//                 :PC_PART,
//                 :PC_UM,
//                 :PC_START,
//                 :PC_EXPIRE,
//                 :PC_MIN_PRICE,
//                 :PC_MAX_PRICE_1,
//                 :PC_MAX_PRICE_2,
//                 :PC_MAX_PRICE_3,
//                 :PC_MAX_PRICE_4,
//                 :PC_MAX_PRICE_5,
//                 :PC_MAX_PRICE_6
                
//             ) ';
//             $PC_LIST = $prepare_data[$i]['PC_LIST'];
//             $PC_PART = $prepare_data[$i]['PC_PART'];
//             $PC_UM=$prepare_data[$i]['PC_UM'];
//             $PC_START=date("Y-m-d h:i:sa");
//             $PC_EXPIRE = date("Y-m-d h:i:sa");
//             $PC_MIN_PRICE = $prepare_data[$i]['PC_MIN_PRICE'];
//             $PC_MAX_PRICE_1 = $prepare_data[$i]['PC_MAX_PRICE##1'];
//             $PC_MAX_PRICE_2=$prepare_data[$i]['PC_MAX_PRICE##2'];
//             $PC_MAX_PRICE_3=$prepare_data[$i]['PC_MAX_PRICE##3'];
//             $PC_MAX_PRICE_4=$prepare_data[$i]['PC_MAX_PRICE##4'];
//             $PC_MAX_PRICE_5=$prepare_data[$i]['PC_MAX_PRICE##5'];
//             $PC_MAX_PRICE_6=$prepare_data[$i]['PC_MAX_PRICE##6'];
            
//             $stmt = $conn->prepare($sql);

//             $stmt->bindParam(':PC_LIST', $PC_LIST,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_PART', $PC_PART,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_UM', $PC_UM,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_START', $PC_START,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_EXPIRE', $PC_EXPIRE,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_MIN_PRICE', $PC_MIN_PRICE,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_MAX_PRICE_1', $PC_MAX_PRICE_1,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_MAX_PRICE_2', $PC_MAX_PRICE_2,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_MAX_PRICE_3', $PC_MAX_PRICE_3,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_MAX_PRICE_4', $PC_MAX_PRICE_4,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_MAX_PRICE_5', $PC_MAX_PRICE_5,PDO::PARAM_STR);
//             $stmt->bindParam(':PC_MAX_PRICE_6', $PC_MAX_PRICE_6,PDO::PARAM_STR);
            
            
//             $stmt->execute();

//         }
