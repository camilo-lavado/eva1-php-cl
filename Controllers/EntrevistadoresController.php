<?php
require_once './Models/Entrevistadores.php';

class EntrevistadoresController
{
    public function listarEntrevistadores()
    {
        header('Content-Type: application/json');
        $entrevistadores = new Entrevistadores();
        $entrevistadoresList = $entrevistadores->getInterviewers();
        return json_encode($entrevistadoresList);
    }
}
