<?php

namespace Apps\Controller\Users;

use Apps\Core\Controller\Request;
use Apps\Model\CRUDSeanceModel;

class DeleteController
{
    public function execute(Request $request){
        $crudDemande = new CRUDSeanceModel();
        if ($_SESSION['IDDEMANDE']!=null OR $_SESSION['IDDEMANDE']!=""){
            $crudDemande->DeleteDemande($_SESSION['IDDEMANDE']);
            header("Location: /Acceuil");
        }
        else {
            header("Location: /Acceuil");

        }
    }
}