<?php
namespace App\Models;

use MF\Model\Model;

class Reembolso extends Model {

    private $Reembolso_Funcionario_Codigo;
    private $Reembolso_Data;
    private $Reembolso_Viagem;
    private $Reembolso_Tipo;
    private $Reembolso_Moeda;
    private $Reembolso_Valor;
    private $Reembolso_Anexo;
    private $Reembolso_Banco;
    private $Reembolso_Pix;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function salvarReembolso() {
        $query = "INSERT INTO rh_reembolso (Reembolso_Data, Reembolso_Funcionario_Codigo, Reembolso_Viagem, 
        Reembolso_Tipo, Reembolso_Moeda, Reembolso_Valor, Reembolso_Anexo, 
        Reembolso_Banco, Reembolso_Pix, Reembolso_Resposta) VALUES (:Reembolso_Data, :Reembolso_Funcionario_Codigo, :Reembolso_Viagem, 
        :Reembolso_Tipo, :Reembolso_Moeda, :Reembolso_Valor, :Reembolso_Anexo, 
        :Reembolso_Banco, :Reembolso_Pix, :Reembolso_Resposta)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':Reembolso_Data', $this->__get('Reembolso_Data'));
        $stmt->bindValue(':Reembolso_Funcionario_Codigo', $this->__get('Reembolso_Funcionario_Codigo'));
        $stmt->bindValue(':Reembolso_Viagem', $this->__get('Reembolso_Viagem'));
        $stmt->bindValue(':Reembolso_Tipo', $this->__get('Reembolso_Tipo'));
        $stmt->bindValue(':Reembolso_Moeda', $this->__get('Reembolso_Moeda'));
        $stmt->bindValue(':Reembolso_Valor', $this->__get('Reembolso_Valor'));
        $stmt->bindValue(':Reembolso_Anexo', $this->__get('Reembolso_Anexo'));
        $stmt->bindValue(':Reembolso_Banco', $this->__get('Reembolso_Banco'));
        $stmt->bindValue(':Reembolso_Pix', $this->__get('Reembolso_Pix'));
        // Sempre cadastra como "Em Análise"
        $stmt->bindValue(':Reembolso_Resposta', 'Em Análise');  
        return $stmt->execute();
    }

    public function getTodos($funcionarioCodigo = null) {
        $query = "SELECT Reembolso_Data, Reembolso_Tipo, Reembolso_Valor, Reembolso_Resposta
                    FROM rh_reembolso ";

        if($funcionarioCodigo) {
            $query .= "WHERE Reembolso_Funcionario_Codigo = :Funcionario_Codigo ";
        }

        $query .= "ORDER BY Reembolso_Data DESC";

        $stmt = $this->db->prepare($query);

        if($funcionarioCodigo) {
            $stmt->bindValue(':Funcionario_Codigo', $funcionarioCodigo);
        }

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
