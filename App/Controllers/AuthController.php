<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

	public function autenticar() {
		
		$funcionario = Container::getModel('Funcionario');
		
		$funcionario->__set('Funcionario_CPF', $_POST['Funcionario_CPF']);
		$funcionario->__set('Funcionario_Senha', $_POST['Funcionario_Senha']);
		
		$funcionario->autenticar();

		if($funcionario->__get('Funcionario_Codigo') != '' && $funcionario->__get('Funcionario_Nome')) {
			
			session_start();

			$_SESSION['Funcionario_Codigo'] = $funcionario->__get('Funcionario_Codigo');
			$_SESSION['Funcionario_Nome'] = $funcionario->__get('Funcionario_Nome');

			header('Location: /home');

		} else {
        	header('Location: /?login=erro');
		}

	}

	public function sair() {
		session_start();
		session_destroy();
		header('Location: /?logout=sucesso');
		exit;
	}
}