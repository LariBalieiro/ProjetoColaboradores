<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class PontoController extends Action {

    public function index() {
        if(session_status() === PHP_SESSION_NONE) session_start();

        $funcionarioCodigo = $_SESSION['Funcionario_Codigo'] ?? null;
        if (!$funcionarioCodigo) {
            header('Location: /login');
            exit;
        }

        $pagina = (int)($_GET['pagina'] ?? 1); 
        $limite = 10;
        $offset = ($pagina - 1) * $limite;

        $pontoModel = Container::getModel('Ponto');
        $this->view->pontos = $pontoModel->getTodos($funcionarioCodigo, $limite, $offset);
        $this->view->total = $pontoModel->getTotal($funcionarioCodigo);
        $this->view->pagina = $pagina;
        $this->view->totalPaginas = ceil($this->view->total / $limite);

        $this->render('app/home');
    }

}
