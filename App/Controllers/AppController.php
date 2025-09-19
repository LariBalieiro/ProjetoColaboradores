<?php
namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

    public function home() {
        session_start();

        if(!empty($_SESSION['Funcionario_Codigo']) && !empty($_SESSION['Funcionario_Nome'])) {
            $funcionarioCodigo = $_SESSION['Funcionario_Codigo'];
            $limite = 10;

            // --------------------------
            // 🔹 Holerites
            // --------------------------
            $paginaHolerite = (int)($_GET['pagina_holerite'] ?? 1);
            $offsetHolerite = ($paginaHolerite - 1) * $limite;

            $holeriteModel = Container::getModel('Holerite');
            $this->view->holerites = $holeriteModel->getTodos($funcionarioCodigo, $limite, $offsetHolerite);
            $totalHolerites = $holeriteModel->getTotal($funcionarioCodigo);
            $this->view->paginaHolerite = $paginaHolerite;
            $this->view->totalPaginasHolerite = ceil($totalHolerites / $limite);

            // --------------------------
            // 🔹 Pontos
            // --------------------------
            $paginaPonto = (int)($_GET['pagina_ponto'] ?? 1);
            $offsetPonto = ($paginaPonto - 1) * $limite;

            $pontoModel = Container::getModel('Ponto');
            $this->view->pontos = $pontoModel->getTodos($funcionarioCodigo, $limite, $offsetPonto);
            $totalPontos = $pontoModel->getTotal($funcionarioCodigo);
            $this->view->paginaPonto = $paginaPonto;
            $this->view->totalPaginasPonto = ceil($totalPontos / $limite);

            // --------------------------
            // 🔹 Comissão
            // --------------------------
            $paginaComissao = (int)($_GET['pagina_comissao'] ?? 1);
            $offsetComissao = ($paginaComissao - 1) * $limite;

            $comissaoModel = Container::getModel('Comissao');
            $this->view->comissaos = $comissaoModel->getTodos($funcionarioCodigo, $limite, $offsetComissao);
            $totalComissaos = $comissaoModel->getTotal($funcionarioCodigo);
            $this->view->paginaComissao = $paginaComissao;
            $this->view->totalPaginasComissao = ceil($totalComissaos / $limite);

            // --------------------------
            // 🔹 Verifica se é vendedor
            // --------------------------
            $funcionarioModel = Container::getModel('Funcionario');
            $dadosFuncionario = $funcionarioModel->getByCodigo($funcionarioCodigo);
            $this->view->isVendedor = $dadosFuncionario['Funcionario_Vendedor'] == 1;

			// --------------------------
			// 🔹 Informe de Rendimentos
			// --------------------------
			$paginaRendimentos = (int)($_GET['pagina_rendimentos'] ?? 1);
			$offsetRendimentos = ($paginaRendimentos - 1) * $limite;

			$rendimentosModel = Container::getModel('Rendimentos');
			$this->view->informederendimentos = $rendimentosModel->getTodos($funcionarioCodigo, $limite, $offsetRendimentos);
			$totalRendimentos = $rendimentosModel->getTotal($funcionarioCodigo);
			$this->view->paginaRendimentos = $paginaRendimentos;
			$this->view->totalPaginasRendimentos = ceil($totalRendimentos / $limite);

            $this->render('home');
        } else {
            header('Location: /?login=erro');
        }
    }

    public function enviarSugestao() {
        $sugestao = Container::getModel('Sugestao');

        $texto = $_POST['Sugestao_Texto'] ?? '';
        $data  = $_POST['Sugestao_Data'] ?? '';

        $sugestao->__set('Sugestao_Texto', $texto);
        $sugestao->__set('Sugestao_Data', $data);

        if($sugestao->salvar()) {
            echo json_encode(['status' => 'success', 'message' => 'Sugestão enviada com sucesso!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar sugestão.']);
        }
    }

    public function reembolso() {
        session_start();
        $reembolsoModel = Container::getModel('Reembolso');
        $funcionarioCodigo = $_SESSION['Funcionario_Codigo'] ?? null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $reembolso = Container::getModel('Reembolso');

            $Reembolso_Data   = $_POST['Reembolso_Data'] ?? '';
            $funcionarioCodigo = $_SESSION['Funcionario_Codigo'] ?? null;
            $Reembolso_Viagem = $_POST['Reembolso_Viagem'] ?? '';
            $Reembolso_Tipo   = $_POST['Reembolso_Tipo'] ?? '';
            $Reembolso_Moeda  = $_POST['Reembolso_Moeda'] ?? '';
            $Reembolso_Valor  = $_POST['Reembolso_Valor'] ?? '';
            $Reembolso_Banco  = $_POST['Reembolso_Banco'] ?? '';
            $Reembolso_Pix    = $_POST['Reembolso_Pix'] ?? '';

            // --- Upload ---
            $Reembolso_Anexo = null;
            if(isset($_FILES['Reembolso_Anexo']) && $_FILES['Reembolso_Anexo']['error'] == 0) {
                $pasta = "PDF/reembolso/";
                if(!is_dir($pasta)) mkdir($pasta, 0777, true);
                $nomeArquivo = basename($_FILES['Reembolso_Anexo']['name']);
                $caminho = $pasta . $nomeArquivo;
                if(move_uploaded_file($_FILES['Reembolso_Anexo']['tmp_name'], $caminho)) {
                    $Reembolso_Anexo = $caminho;
                }
            }

            $reembolso->__set('Reembolso_Data', $Reembolso_Data);
            $reembolso->__set('Reembolso_Funcionario_Codigo', $funcionarioCodigo);
            $reembolso->__set('Reembolso_Viagem', $Reembolso_Viagem);
            $reembolso->__set('Reembolso_Tipo', $Reembolso_Tipo);
            $reembolso->__set('Reembolso_Moeda', $Reembolso_Moeda);
            $reembolso->__set('Reembolso_Valor', $Reembolso_Valor);
            $reembolso->__set('Reembolso_Anexo', $Reembolso_Anexo);
            $reembolso->__set('Reembolso_Banco', $Reembolso_Banco);
            $reembolso->__set('Reembolso_Pix', $Reembolso_Pix);

            if($reembolso->salvarReembolso()) {
                echo json_encode(['status' => 'success', 'message' => 'Reembolso enviado com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar reembolso.']);
            }
            exit;
        }

        $this->view->funcionarioCodigo = $funcionarioCodigo;
        $this->view->reembolsos = $reembolsoModel->getTodos($funcionarioCodigo);
        $this->render('reembolso');
    }

    public function alterarSenha() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');

            if (!empty($_POST['Funcionario_Codigo']) && !empty($_POST['senhaAtual']) && !empty($_POST['novaSenha']) && !empty($_POST['confirmarSenha'])) {

                $Funcionario_Codigo = $_POST['Funcionario_Codigo'] ?? '';
                $senhaAtual         = $_POST['senhaAtual'] ?? '';
                $novaSenha          = $_POST['novaSenha'] ?? '';
                $confirmarSenha     = $_POST['confirmarSenha'] ?? '';
                
                $funcionarioModel = Container::getModel('Funcionario');
                $result = $funcionarioModel->alterarSenha($Funcionario_Codigo, $senhaAtual, $novaSenha, $confirmarSenha);

                if ($result === true) {
                    echo json_encode(['status' => 'success', 'message' => 'Senha atualizada com sucesso!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => $result]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Todos os campos são obrigatórios.']);
            }
            exit;
        } else {
            $this->render('alterarSenha');
        }
    }

}
