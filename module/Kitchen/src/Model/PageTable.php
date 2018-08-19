<?php
	namespace Kitchen\Model;
	use Zend\Db\TableGateway\TableGatewayInterface;
	
	class PageTable {
		protected $tableGateway;
		
		public function __construct(TableGatewayInterface $tableGateway) {
			$this->tableGateway = $tableGateway;
		}
		
		public function fetchAll() {
			$resultSet = $this->tableGateway->select();
			return $resultSet;
		}
		
		public function selectFromId($id) {
			$resultSet = $this->tableGateway->select(array("id" => $id));
			return $resultSet;
		}
	}