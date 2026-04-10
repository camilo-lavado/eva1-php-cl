<?php
require_once './Models/Cargos.php';

class CargosController
{
    public function listarCargos()
    {
        header('Content-Type: application/json');
        $cargos = new Cargos();
        $cargosList = $cargos->getCharges();
        return json_encode($cargosList);
    }
}
