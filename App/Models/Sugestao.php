<?php

namespace App\Models;

use MF\Model\Model;

class Sugestao extends Model {

    private $Sugestao_Texto;
    private $Sugestao_Data;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function salvar() {
        $query = "INSERT INTO rh_sugestao (Sugestao_Texto, Sugestao_Data) VALUES (:Sugestao_Texto, :Sugestao_Data)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':Sugestao_Texto', $this->__get('Sugestao_Texto'));
        $stmt->bindValue(':Sugestao_Data', $this->__get('Sugestao_Data'));
        
        $resultado = $stmt->execute();
        return $resultado;
    }
}
