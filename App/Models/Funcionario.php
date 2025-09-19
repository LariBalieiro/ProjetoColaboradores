<?php

namespace App\Models;

use MF\Model\Model;

class Funcionario extends Model
{

	private $Funcionario_Codigo;
	private $Funcionario_Nome;
	private $Funcionario_CPF;
	private $Funcionario_Senha;

	public function __get($atributo)
	{
		return $this->$atributo;
	}

	public function __set($atributo, $valor)
	{
		$this->$atributo = $valor;
	}

	public function getFuncionarioPorCPF()
	{
		$query = "SELECT Funcionario_Codigo, 
		Funcionario_Nome, Funcionario_CPF, 
		Funcionario_Senha
		FROM funcionario 
		WHERE Funcionario_Deletado = 0 
		AND Funcionario_Acesso = 1
		AND Funcionario_CPF = :Funcionario_CPF";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':Funcionario_CPF', $this->__get('Funcionario_CPF'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getByCodigo($codigo)
	{
		if (!$codigo) return null;

		$query = "SELECT * 
					FROM funcionario 
					WHERE Funcionario_Codigo = :codigo 
					LIMIT 1";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':codigo', $codigo, \PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function autenticar()
	{
		$PASS = md5("holpass");

		$senha = md5(md5($this->__get('Funcionario_Senha')) . $PASS);

		// Normaliza o CPF (remove pontos e traços)
		$cpf = preg_replace('/\D/', '', $this->__get('Funcionario_CPF'));

		$query = "SELECT Funcionario_Codigo, 
						Funcionario_Nome, Funcionario_CPF, 
						Funcionario_Senha
				FROM funcionario 
				WHERE Funcionario_Deletado = 0 
				AND Funcionario_Acesso = 1
				AND Funcionario_CPF = :Funcionario_CPF
				AND Funcionario_Senha = :Funcionario_Senha";

		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':Funcionario_CPF', $cpf);
		$stmt->bindValue(':Funcionario_Senha', $senha);
		$stmt->execute();

		$funcionario = $stmt->fetch(\PDO::FETCH_ASSOC);

		if ($funcionario) {
			$this->__set('Funcionario_Codigo', $funcionario['Funcionario_Codigo']);
			$this->__set('Funcionario_Nome', $funcionario['Funcionario_Nome']);
		} else {
			// debug extra
			echo "<pre>";
			echo "Query não retornou funcionário.\n";
			echo "CPF usado na query: {$cpf}\n";
			echo "Senha gerada: {$senha}\n";
			echo "</pre>";
		}

		return $this;
	}

	public function alterarSenha($Funcionario_Codigo, $senhaAtual, $novaSenha, $confirmarSenha)
	{
		$pass = md5("holpass"); // salt fixo (já md5ado)
		$senhaAtualHash = md5(md5($senhaAtual) . $pass);

		$sql = "SELECT Funcionario_Senha FROM funcionario WHERE Funcionario_Codigo = :codigo";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':codigo', $Funcionario_Codigo);
		$stmt->execute();
		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

		if (!$usuario) {
			return "Usuário não encontrado.";
		}

		if ($usuario['Funcionario_Senha'] !== $senhaAtualHash) {
			return "Senha atual incorreta.";
		}

		if ($novaSenha !== $confirmarSenha) {
			return "As senhas novas não coincidem.";
		}

		$novaSenhaHash = md5(md5($novaSenha) . $pass);

		$sqlUpdate = "UPDATE funcionario SET Funcionario_Senha = :novaSenha WHERE Funcionario_Codigo = :codigo";
		$stmtUpdate = $this->db->prepare($sqlUpdate);
		$stmtUpdate->bindValue(':novaSenha', $novaSenhaHash);
		$stmtUpdate->bindValue(':codigo', $Funcionario_Codigo);

		if ($stmtUpdate->execute()) {
			return true;
		}

		return "Erro ao atualizar a senha.";
	}
}
