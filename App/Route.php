<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['index'] = array(
			'route' => '/',
			'controller' => 'IndexController',
			'action' => 'index'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['home'] = array(
			'route' => '/home',
			'controller' => 'AppController',
			'action' => 'home'
		);

		$routes['holerite'] = array(
            'route' => '/holerite',
            'controller' => 'HoleriteController',
            'action' => 'index'
        );

		$routes['ponto'] = array(
            'route' => '/ponto',
            'controller' => 'PontoController',
            'action' => 'index'
        );

		$routes['enviarSugestao'] = array(
			'route' => '/enviarSugestao',
			'controller' => 'AppController',
			'action' => 'enviarSugestao'
		);

		$routes['reembolso'] = array(
			'route' => '/reembolso',
			'controller' => 'AppController',
			'action' => 'reembolso'
		);

		$routes['alterarSenha'] = array(
			'route' => '/alterarSenha',
			'controller' => 'AppController',
			'action' => 'alterarSenha'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$this->setRoutes($routes);
	}

}

?>