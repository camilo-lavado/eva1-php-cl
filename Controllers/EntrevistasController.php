<?php
require_once './Models/Entrevistas.php';

class EntrevistasController
{
    public function listarEntrevistas()
    {
        header('Content-Type: application/json');
        $entrevistas = new Entrevistas();
        $entrevistasList = $entrevistas->getInterviews();
        return json_encode($entrevistasList);
    }
}
