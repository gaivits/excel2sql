<?php
require_once("../../tsttest/vendor/autoload.php");
require_once("../../tsttest/connections.php");


use PhpOffice\PhpSpreadsheet\IOFactory;

class convert_excel_sql_models extends connections
{

    function insert_from_excel($files)
    {
        $conn = $this->oracleMyConn();

        // Specify the path to your Excel file
        $excelFilePath = "/usr/share/nginx/erp.365supplychain.com/upload_price_table/tsttest/documents/{$files}";

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
                if ($col == 'C') {
                    $new_name_col = 'PC_UM';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'D') {
                    $new_name_col = 'PC_MIN_PRICE';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'E') {
                    $new_name_col = 'PC_MAX_PRICE##1';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'F') {
                    $new_name_col = 'PC_MAX_PRICE##2';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'G') {
                    $new_name_col = 'PC_MAX_PRICE##3';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'H') {
                    $new_name_col = 'PC_MAX_PRICE##4';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'I') {
                    $new_name_col = 'PC_MAX_PRICE##5';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'J') {
                    $new_name_col = 'PC_MAX_PRICE##6';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'K') {
                    $new_name_col = 'PC_START';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
                if ($col == 'L') {
                    $new_name_col = 'PC_EXPIRE';
                    $prepare_data[$row][$new_name_col] = $cellValue;
                }
            }
        }

        for ($i = 2; $i < count($prepare_data); $i++) {

            $PC_LIST = $prepare_data[$i]['PC_LIST'];
            $PC_PART = $prepare_data[$i]['PC_PART'];
            $PC_UM = $prepare_data[$i]['PC_UM'];
            $PC_MIN_PRICE = $prepare_data[$i]['PC_MIN_PRICE'];
            $PC_MAX_PRICE_1 = $prepare_data[$i]['PC_MAX_PRICE##1'];
            $PC_MAX_PRICE_2 = $prepare_data[$i]['PC_MAX_PRICE##2'];
            $PC_MAX_PRICE_3 = $prepare_data[$i]['PC_MAX_PRICE##3'];
            $PC_MAX_PRICE_4 = $prepare_data[$i]['PC_MAX_PRICE##4'];
            $PC_MAX_PRICE_5 = $prepare_data[$i]['PC_MAX_PRICE##5'];
            $PC_MAX_PRICE_6 = $prepare_data[$i]['PC_MAX_PRICE##6'];


            // $PC_MIN_PRICE = $prepare_data[$i]['PC_MIN_PRICE'];
            // $PC_MAX_PRICE_1 = $prepare_data[$i]['PC_MAX_PRICE##1'];
            // $PC_MAX_PRICE_2 = $prepare_data[$i]['PC_MAX_PRICE##2'];
            // $PC_MAX_PRICE_3 = $prepare_data[$i]['PC_MAX_PRICE##3'];
            // $PC_MAX_PRICE_4 = $prepare_data[$i]['PC_MAX_PRICE##4'];
            // $PC_MAX_PRICE_5 = $prepare_data[$i]['PC_MAX_PRICE##5'];
            // $PC_MAX_PRICE_6 = $prepare_data[$i]['PC_MAX_PRICE##6'];
            $sql = 'INSERT INTO TSTTEST.PC_MSTR (
                PC_LIST,
                PC_PART,
                PC_UM,
                PC_MIN_PRICE,
                "PC_MAX_PRICE##1",
                "PC_MAX_PRICE##2",
                "PC_MAX_PRICE##3",
                "PC_MAX_PRICE##4",
                "PC_MAX_PRICE##5",
                "PC_MAX_PRICE##6"
               
                
                
         
         ) VALUES(:PC_LIST,
         :PC_PART,
         :PC_UM,
         :PC_MIN_PRICE,
         :PC_MAX_PRICE_1,
         :PC_MAX_PRICE_2,
         :PC_MAX_PRICE_3,
         :PC_MAX_PRICE_4,
         :PC_MAX_PRICE_5,
         :PC_MAX_PRICE_6
         )';



            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':PC_LIST', $PC_LIST, PDO::PARAM_STR);
            $stmt->bindParam(':PC_PART', $PC_PART, PDO::PARAM_STR);
            $stmt->bindParam(':PC_UM', $PC_UM, PDO::PARAM_STR);
            $stmt->bindParam(':PC_MIN_PRICE', $PC_MIN_PRICE, PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_1', $PC_MAX_PRICE_1,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_2', $PC_MAX_PRICE_2,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_3', $PC_MAX_PRICE_3,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_4', $PC_MAX_PRICE_4,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_5', $PC_MAX_PRICE_5,PDO::PARAM_STR);
            $stmt->bindParam(':PC_MAX_PRICE_6', $PC_MAX_PRICE_6,PDO::PARAM_STR);
            

            
            
            try {
                $stmt->execute();
            } catch (PDOException $e) {
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