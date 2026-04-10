<?php
require_once './Models/Experiencias.php';

class ExperienciasController
{
    public function listarExperiencias()
    {
        header('Content-Type: application/json');
        $experiencias = new Experiencias();
        $experienciasList = $experiencias->getExperiences();
        return json_encode($experienciasList);
    }
}
