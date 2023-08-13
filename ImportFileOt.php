<?php
    include_once 'init/config.php';
    require_once "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
        
        if(isset($_POST["ImportBtnPhpOt"])) {
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
            $filename = $_FILES["InputExcel"]["name"];
            if(!empty($_FILES['InputExcel']['name']) && in_array($_FILES['InputExcel']['type'], $excelMimes)){
                if(is_uploaded_file($_FILES['InputExcel']['tmp_name'])){
                    $Rd=new Xlsx();
                    $spreaderShet = $Rd->load($_FILES["InputExcel"]['tmp_name']);
                    $workshet = $spreaderShet->getActiveSheet();
                    $workshet_arr = $workshet->toArray();
                    $isTheFirstRow = true;
                    $startRow = 0;
                    foreach($workshet_arr as $row)
                    {

                        if($isTheFirstRow){
                            if($startRow<24){
                                $startRow++;
                                continue ;
                            }
                            $isTheFirstRow = true;
                        }
                        $OT_Number = $row[0];
                        $xt=str_replace('"', "'", $row[1]);    
                        $escapedText = htmlspecialchars($xt, ENT_QUOTES, 'UTF-8');
                        $Description_OT = $escapedText;
                        $OT_Sous_traitance = $row[2];
                        $Type_OT = $row[3];
                        $OT_Preventif = $row[4];
                        $Activite = $row[5];
                        $Type_activite = $row[6];
                        $Motif_activite = $row[7];
                        $Origine_activite = $row[8];
                        $Priorit = $row[9];
                        $Numero_equipement  = $row[10];
                        $Groupe_equipement= $row[11];
                        $Desciption_equipement = $row[12];
                        $Numero_equipement_parent = $row[13];
                        $DI_Number = $row[14];
                        $Type_arret= $row[15];
                        if(!empty($row[16])){
                            $dt1 = DateTime::createFromFormat('n/j/Y H:i', $row[16]);
                            $frmt1 = $dt1->format('Y-m-d H:i:s');
                            $Date_de_debut_programmee= $frmt1;
                        }else{
                            $cdt1 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt1 = $cdt1->format('Y-m-d H:i:s');
                            $Date_de_debut_programmee = $cfrmdt1;
                        }

                        if(!empty($row[17])){
                            $dt2 = DateTime::createFromFormat('n/j/Y H:i', $row[17]);
                            $frmt2 = $dt2->format('Y-m-d H:i:s');
                            $Date_de_fin_planifiee = $frmt2;
                        }else{
                            $cdt2 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt2 = $cdt2->format('Y-m-d H:i:s');
                            $Date_de_fin_planifiee = $cfrmdt2;
                        }

                        if(!empty($row[18])){
                            $dt3 = DateTime::createFromFormat('n/j/Y H:i', $row[18]);
                            $frmt3 = $dt3->format('Y-m-d H:i:s');
                            $Date_de_creation = $frmt3;
                        }else{
                            $cdt3 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt3 = $cdt3->format('Y-m-d H:i:s');
                            $Date_de_creation = $cfrmdt3;
                        }
                        if(!empty($row[19])){
                            $dt4 = DateTime::createFromFormat('n/j/Y H:i', $row[19]);
                            $frmt4 = $dt4->format('Y-m-d H:i:s');
                            $Date_de_mise_a_jour = $frmt4;
                        }else{
                            $cdt4 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt4 = $cdt4->format('Y-m-d H:i:s');
                            $Date_de_mise_a_jour = $cfrmdt4;
                        }
                        if(!empty($row[20])){
                            $Duree_estimee = $row[20];
                        }else{
                            $Duree_estimee = 0; 
                        }
                        if(!empty($row[21])){
                            $Duree_reelle = $row[21];
                        }else{
                            
                        $Duree_reelle = 0;
                        }
                        $Section = $row[22];
                        $Statut = $row[23];
                        if(!empty($row[24]))
                        {
                            $dt5 = DateTime::createFromFormat('n/j/Y H:i', $row[24]);
                            $frmt5 = $dt5->format('Y-m-d H:i:s');
                            $Date_de_lancement = $frmt5;
                        }else{
                            $cdt5 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt5 = $cdt5->format('Y-m-d H:i:s');
                            $Date_de_lancement  = $cfrmdt5;
                        }

                        if(!empty($row[25])){
                            $dtTer = DateTime::createFromFormat('n/j/Y H:i', $row[25]);
                            $frmTer = $dtTer->format("Y-m-d H:i:s");
                            $Termine_le= $row[25];                             
                        }else{
                            $cdt66 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt66 = $cdt66->format('Y-m-d H:i:s');
                            $Termine_le= $cfrmdt66; 
                        }

                        if(!empty($row[26])){
                            $dt6 = DateTime::createFromFormat('n/j/Y H:i', $row[26]);
                            $frmt6 = $dt6->format('Y-m-d H:i:s');
                            $Date_de_cloture= $frmt6;
                        }else{
                            $cdt6 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt6 = $cdt6->format('Y-m-d H:i:s');
                            $Date_de_cloture = $cfrmdt6;
                        }
                        $Classe = $row[27];
                        $Commentaire= $row[28];
                        $Cout_Matiere= $row[29];
                        $Cout_Main_oeuvre= $row[30];
                        $Cout_sous_traitance= $row[31];
                        $Planifie= $row[32];
                        $Urgence= $row[33];
                        $Impact= $row[34];
                        $Sous_planification= $row[35];
                        $Cause_de_non_realisation_OT= $row[36];
                        $Types_arret_pecifiques= $row[37];
                        $UO_Estimees= $row[38];
                        $ST_UO_Estimees= $row[39];
                        $UO_Reelles= $row[40];
                        $ST_UO_Reelles= $row[41];
                        if(!empty($row[42])){
                            $dt7 = DateTime::createFromFormat('n/j/Y H:i', $row[42]);
                            $frmt7 = $dt7->format('Y-m-d H:i:s');
                            $Date_de_panne= $frmt7;
                        }else{                     
                            $cdt7 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt7 = $cdt7->format('Y-m-d H:i:s');
                            $Date_de_panne = $cfrmdt7;
                        }             
                        $Code_panne= $row[43];
                        $Description_panne= $row[44];
                        $Cause_panne= $row[45];
                        $Description_cause= $row[46];
                        $Resolution_panne= $row[47];
                        $Description_resolution= $row[48];
                        $Ressources= $row[49];
                        $Commentaires_sur_la_panne= $row[50];
                        $OT_parent= $row[51];
                        $Cree_par= $row[51];
                        $Mis_a_jour_par = $row[52];
                        $currDate = new DateTime();
                        $currDate2 = $currDate->format('Y-m-d H:i:s');
                        $DateImport = $currDate2;
                        
                        $query = "INSERT INTO `ot`  (`OT_Number`, `Description_OT`, `OT_Sous_traitance`, `Type_OT`, `OT_Preventif`, `Activite`, `Type_activite`, `Motif_activite`, `Origine_activite`, `Priorit`, `Numero_equipement`, `Groupe_equipement`, `Desciption_equipement`, `Numero_equipement_parent`, `DI_Number`, `Type_arret`, `Date_de_debut_programmee`, `Date_de_fin_planifiee`, `Date_de_creation`, `Date_de_mise_a_jour`, `Duree_estimee`, `Duree_reelle`, `Section`, `Statut`, `Date_de_lancement`, `Termine_le`, `Date_de_cloture`, `Commentaire`, `Cout_Matiere`, `Cout_Main_oeuvre`, `Cout_sous_traitance`, `Planifie`, `Urgence`, `Impact`, `Sous_planification`, `Cause_de_non_realisation_OT`, `Types_arret_pecifiques`, `UO_Estimees`, `ST_UO_Estimees`, `UO_Reelles`, `ST_UO_Reelles`, `Date_de_panne`, `Code_panne`, `Description_panne`, `Cause_panne`, `Description_cause`, `Resolution_panne`, `Description_resolution`, `Ressources`, `Commentaires_sur_la_panne`, `OT_parent`, `Cree_par`, `Mis_a_jour_par`, `ImprtId`,`DateImport`) VALUES
                                                    (\"$OT_Number\", \"$Description_OT\", \"$OT_Sous_traitance\", \"$Type_OT\", \"$OT_Preventif\", \"$Activite\", \"$Type_activite\", \"$Motif_activite\", \"$Origine_activite\", \"$Priorit\", \"$Numero_equipement\", \"$Groupe_equipement\", \"$Desciption_equipement\", \"$Numero_equipement_parent\", \"$DI_Number\", \"$Type_arret\", \"$Date_de_debut_programmee\", \"$Date_de_fin_planifiee\", \"$Date_de_creation\", \"$Date_de_mise_a_jour\", \"$Duree_estimee\", \"$Duree_reelle\", \"$Section\", \"$Statut\", \"$Date_de_lancement\", \"$Termine_le\", \"$Date_de_cloture\", \"$Commentaire\", \"$Cout_Matiere\", \"$Cout_Main_oeuvre\", \"$Cout_sous_traitance\", \"$Planifie\", \"$Urgence\", \"$Impact\", \"$Sous_planification\", \"$Cause_de_non_realisation_OT\", \"$Types_arret_pecifiques\", \"$UO_Estimees\", \"$ST_UO_Estimees\", \"$UO_Reelles\", \"$ST_UO_Reelles\", \"$Date_de_panne\", \"$Code_panne\", \"$Description_panne\", \"$Cause_panne\", \"$Description_cause\", \"$Resolution_panne\", \"$Description_resolution\", \"$Ressources\", \"$Commentaires_sur_la_panne\", \"$OT_parent\", \"$Cree_par\", \"$Mis_a_jour_par\",\"$ImprtId\",\" $DateImport \");";  
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