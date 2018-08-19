<?php
	namespace Kitchen;

	use Zend\ServiceManager\Factory\InvokableFactory;
	use Zend\Router\Http\Segment;

	return [
		'controllers' => [
			'factories' => [
				Controller\KitchenController::class => function ($container) {
					return new Controller\KitchenController(
						$container->get(Model\PageTable::class)
					);
				}
			]
		],
		'router' => [
			'routes' => [
				'kitchen' => [
					'type' => Segment::class,
						'options' => [
							'route' => '/kitchen[/:action[/:id]]',
							'constraints' => [
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'id' => '[a-zA-Z0-9_-]+',
							],
							'defaults' => [
								'controller' => Controller\KitchenController::class,
								'action' => 'index'
							]
						]
				]
			]
		],
		'view_manager' => [
			'template_path_stack' => ['kitchen' => __DIR__.'/../view']
		]
	];
