<?php   
 require_once("model.php");
 $db=new Database();


if (isset($_POST["action"])  && $_POST["action"]==='create'  ) {
   extract($_POST);
    $returned =(int)$amount-(int)$received;  
    $db->create($customer,$cashier, (int)$amount,(int)$received,(int)$returned,$etat);
}

if (isset($_POST["action"])  && $_POST["action"]==='fetch'  ) {
       $output='';
       $billes=$db->getfactures();

    if ($db->countBills()>0) {
      $output.='    <table class="table table-stripe">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Client</th>
                    <th scope="col">Caissier</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Rerçu</th>
                    <th scope="col">Retourné</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
             <tbody>'; 
      
      foreach ($billes as $bil) {
       
        $output.=" <tr>
                        <th scope=\"row\">  $bil->id  </th>
                        <td>$bil->customer </td>
                        <td>$bil->cashier </td>
                        <td>$bil->amount </td>
                        <td>$bil->received </td>
                        <td>$bil->returned </td>
                        <td>$bil->etat</td>
                        
                        <td>
                            <a href= \"#\"  title=\"Voir Détails\" data-id=\"$bil->id\" class=\"text-info me-2 infoBtn\"> <i class=\"fas fa-info-circle\"></i> </a>
                            <a href= \"#\"  title=\"Modifier\" data-id=\"$bil->id\" data-bs-toggle=\"modal\" data-bs-target=\"#updatmodal\" class=\"text-primary me-2 editBtn\"> <i class=\"fas fa-edit\"></i> </a>
                            <a href= \"#\"  title=\"Supprimer\" data-id=\"$bil->id\"  class=\"text-danger me-2 deleteBtn\"> <i class=\"fas fa-trash-alt\"></i> </a>
                        </td>
                    </tr>";
      }
      $output.=' </tbody></table>';

      echo $output;
     }else{
        echo '<h3> Pas de factures pour le moment !! </h3>';
     }

 }




if (isset($_POST["action"])  && $_POST["action"]==='updat'  ) {
   extract($_POST);
//    updatcustomer  updatcashier  updatamount  updatreceived  updatetat
    $updatreturned =(int)$updatamount-(int)$updatreceived;  

    $db->updat($updatcustomer,$updatcashier, (int)$updatamount, (int)$updatreceived, (int)$updatreturned, $updatetat, (int)$id_facture);
}



if (isset($_POST["id_update"]) || isset($_POST["id_info"]) ) {

       if (isset($_POST["id_update"])) {
        $ids= (int)$_POST["id_update"];
    }else{
        $ids= (int)$_POST["id_info"];
    }
      
      echo json_encode($db->getfacture($ids)); 
}



if (isset($_POST["id_supp"]) ) {
      $id=(int)$_POST["id_supp"];
     echo $db->deletfacture($id);
 }


//exportation en excel :
 if (isset($_GET["action"]) && $_GET["action"]==='export' ) {
$FilenameExcel ="Facture".date('ymdhis').".xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$FilenameExcel");




    
}


?>