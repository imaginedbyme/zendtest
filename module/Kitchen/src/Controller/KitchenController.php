<?php
	namespace Kitchen\Controller;
	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\Mvc\MvcEvent;
	use Zend\View\Model\ViewModel;
	use Kitchen\Model\PageTable;

	class KitchenController extends AbstractActionController {
		private $table;
		
		public function __construct(PageTable $table) {
			$this->table = $table;
		}
		
		public function indexAction() {
			$view =  new ViewModel([
				'message' => 'Hello, Tutorial'
			]);
			return $view;
		}

		public function pageAction() {
			$dataSet = $this->table->selectFromId($this->params()->fromRoute('id', 0));
			$pages = $this->table->fetchAll();
			if($dataSet->count()==0)
			{
				$this->getResponse()->setStatusCode(404);
				$this->getEvent()->setName(MvcEvent::EVENT_DISPATCH_ERROR);
				$this->getEvent()->getApplication()->getEventManager()->triggerEvent($this->getEvent());
				return false;
			}
			
			$data = $dataSet->current();
			
			$view = new ViewModel(array(
	            'message' => 'Hello world',
				'data' => $data,
				'pages' => $pages
	        ));
			
	        $view->setTemplate("kitchen/kitchen/page.phtml");
			return $view;
		}
	}
