<?php 

   
$cdt1 = DateTime::createFromFormat('m/d/Y H:i:s', date('d/m/Y H:i:s', 0));
                            $cfrmdt1 = $cdt1->format('Y-m-d H:i:s');
                            $Date_de_debut_programmee = $cfrmdt1;
echo "Epoch date: $Date_de_debut_programmee";


?>