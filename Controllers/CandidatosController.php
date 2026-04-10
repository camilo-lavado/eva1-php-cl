<?php
require_once './Models/Candidatos.php';

class CandidatosController
{
    public function listarCandidatos()
    {
        header('Content-Type: application/json');
        $candidatos = new Candidatos();
        $candidatosList = $candidatos->getCandidates();
        return json_encode($candidatosList);
    }
}
