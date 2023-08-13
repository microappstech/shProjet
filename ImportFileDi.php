<?php
    include_once 'init/config.php';
    require_once "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
        
        if(isset($_POST["ImportBtnPhpDi"])) {
            // Allowed mime types 
            $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
            $uploadDir = 'uploads/';   
            $uid = uniqid();
            $Date = date('d/m/Y');
            $dateObject = DateTime::createFromFormat('d/m/Y', $Date);
            $day = $dateObject->format('d');
            $month = $dateObject->format('m');
            $year = $dateObject->format('y');
            $ImprtId = $uid."_".$day."_".$month."_".$year;       
            $filename = $_FILES["InputExcelDi"]["name"];
            if(!empty($_FILES['InputExcelDi']['name']) && in_array($_FILES['InputExcelDi']['type'], $excelMimes)){
                if(is_uploaded_file($_FILES['InputExcelDi']['tmp_name'])){
                    $Rd=new Xlsx();
                    $spreaderShet = $Rd->load($_FILES["InputExcelDi"]['tmp_name']);
                    $workshet = $spreaderShet->getActiveSheet();
                    $workshet_arr = $workshet->toArray();
                    $isTheFirstRow = true;
                    $startRow = 0;
                    foreach($workshet_arr as $row)
                    {
                        if($isTheFirstRow){
                            if($startRow<11){
                                $startRow++;
                                continue ;
                            }
                            $isTheFirstRow = true;
                        }
                        $EquipmentNumber = $row[0];
                        $EquipmentType = $row[1];
                        $DI_Number = $row[2];
                        $xt=str_replace('"', "'", $row[3]);    
                        $escapedText = htmlspecialchars($xt, ENT_QUOTES, 'UTF-8');
                        $Description = $escapedText;                        
                        $RequestedBy = $row[4];
                        $CreatedBy = $row[5];
                        $DI_Status = $row[6];
                        if(!empty($row[7])){
                            $dt1 = DateTime::createFromFormat('n/j/Y H:i', $row[7]);
                            $frmt1 = $dt1->format('Y-m-d H:i:s');
                            $DI_CreationDate= $frmt1;
                        }else{
                            $cdt1 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt1 = $cdt1->format('Y-m-d H:i:s');
                            $DI_CreationDate = $cfrmdt1;
                        } 
                        if(!empty($row[8])){
                            $dt2 = DateTime::createFromFormat('n/j/Y H:i', $row[8]);
                            $frmt2 = $dt2->format('Y-m-d H:i:s');
                            $DI_UpdateDate= $frmt2;
                        }else{
                            $cdt2 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt2 = $cdt2->format('Y-m-d H:i:s');
                            $DI_UpdateDate = $cfrmdt2;
                        } 
                        $OT_Number = $row[9];
                        $OT_Status  = $row[10];
                        if(!empty($row[11])){
                            $dt3 = DateTime::createFromFormat('n/j/Y H:i', $row[11]);
                            $frmt3 = $dt3->format('Y-m-d H:i:s');
                            $OT_CreationDate= $frmt3;
                        }else{
                            $cdt3 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt3 = $cdt3->format('Y-m-d H:i:s');
                            $OT_CreationDate = $cfrmdt3;
                        } 
                        $AssignedSection = $row[12];
                        $RequestingService = $row[13];
                        if(!empty($row[14])){
                            $dt4 = DateTime::createFromFormat('n/j/Y H:i', $row[14]);
                            $frmt4 = $dt4->format('Y-m-d H:i:s');
                            $DI_ApprovalDate= $frmt4;
                        }else{
                            $cdt4 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt4 = $cdt4->format('Y-m-d H:i:s');
                            $DI_ApprovalDate = $cfrmdt4;
                        } 
                        $RejectionReason= $row[15];
                        $Criticite = $row[16];
                        $currDate = new DateTime();
                        $currDate2 = $currDate->format('Y-m-d H:i:s');
                        $DateCreation = $currDate2;
                        
                        $query = "INSERT INTO `di`(`EquipmentNumber`, `EquipmentType`, `DI_Number`, `Description`, `RequestedBy`, `CreatedBy`, `DI_Status`,`DI_CreationDate`,`DI_UpdateDate`,`OT_Number`,`OT_Status`,`OT_CreationDate`,`AssignedSection`,`RequestingService`,`DI_ApprovalDate`,`RejectionReason`,`Criticite`,`UniqKey`,`DateCreation`)
                                          VALUES  (\"$EquipmentNumber\",\"$EquipmentType\", \"$DI_Number\",  \"$Description\", \"$RequestedBy\", \"$CreatedBy\", \"$DI_Status\",    \"$DI_CreationDate\" , \"$DI_UpdateDate\",\"$OT_Number\",\"$OT_Status\", \"$OT_CreationDate\", \"$AssignedSection\", \"$RequestingService\", \"$DI_ApprovalDate\",\"$RejectionReason\", \"$Criticite\",\"$ImprtId\",\"$DateCreation\");";
                        // echo $query;
                        $result = $con->query($query);
                        if($result){
                            $queryString = '?status=Success';
                        }else{
                            $queryString = '?status=Wrong';
                        }
                    }
                }else{
                    $queryString = '?status=Fail';
                }
            }else{
                $queryString = '?status=Invalid_File';
            }
            header("Location: index.php".$queryString); 
        }
    ?>