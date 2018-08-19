<?php
	// Specify our application namespace
	namespace Kitchen;

	// Add the reference to the ConfigProviderInterface class so we can inherit/implement it
	use Zend\Db\Adapter\AdapterInterface;
	use Zend\Db\ResultSet\ResultSet;
	use Zend\Db\TableGateway\TableGateway;
	use Zend\ModuleManager\Feature\ConfigProviderInterface;

	// Define our module class
	class Module implements ConfigProviderInterface {
		// Define the getConfig function
		public function getConfig() {
			// Return our config file
			return include __DIR__ . '/../config/module.config.php';
		}
		
		public function getServiceConfig() {
			return [
				'factories' => [
					Model\PageTable::class => function ($container) {
						$tableGateway = $container->get(Model\PageTableGateway::class);
						$table = new Model\PageTable($tableGateway);
						return $table;
					},
					Model\PageTableGateway::class => function ($container) {
						$dbAdapter = $container->get(AdapterInterface::class);
						$resultSetPrototype = new ResultSet();
						$resultSetPrototype->setArrayObjectPrototype(new Model\Page());
						return new TableGateway('pages', $dbAdapter, null, $resultSetPrototype);
					}
				]
			];
		}
	}
