<?php
namespace App\Models;

use MF\Model\Model;

class Comissao extends Model {

    public function getTodos($funcionarioCodigo, $limit = 10, $offset = 0) {
        if (!$funcionarioCodigo) return [];

        $stmt = $this->db->prepare("
            SELECT * 
            FROM rh_comissao 
            INNER JOIN funcionario  
                ON Funcionario_Codigo = Comissao_Funcionario_Codigo
            WHERE Comissao_Funcionario_Codigo = :Funcionario_Codigo
                AND Funcionario_Vendedor = 1
            ORDER BY STR_TO_DATE(Comissao_Data, '%m/%Y') DESC
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue(':Funcionario_Codigo', $funcionarioCodigo, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTotal($funcionarioCodigo) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as total 
            FROM rh_comissao 
            INNER JOIN funcionario f 
                ON Funcionario_Codigo = Comissao_Funcionario_Codigo
            WHERE Comissao_Funcionario_Codigo = :Funcionario_Codigo
                AND Funcionario_Vendedor = 1
        ");
        $stmt->execute([':Funcionario_Codigo' => $funcionarioCodigo]);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }
}
