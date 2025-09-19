<?php
namespace App\Models;

use MF\Model\Model;

class Holerite extends Model {

    public function getTodos($funcionarioCodigo, $limit = 10, $offset = 0) {
        if (!$funcionarioCodigo) return [];

        $stmt = $this->db->prepare("
            SELECT * FROM rh_holerite
            WHERE Holerite_Funcionario_Codigo = :Funcionario_Codigo
            ORDER BY STR_TO_DATE(Holerite_Data, '%d/%m/%Y') DESC
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
            SELECT COUNT(*) as total FROM rh_holerite
            WHERE Holerite_Funcionario_Codigo = :Funcionario_Codigo
        ");
        $stmt->execute([':Funcionario_Codigo' => $funcionarioCodigo]);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }
}

?>