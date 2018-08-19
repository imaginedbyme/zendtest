<?php
	namespace Kitchen\Model;
	class Page {
		public $id;
		public $page_name;
		public $page_content;
		
		public function exchangeArray($data) {
			$this->id = (!empty($data['id'])) ? $data['id'] : null;
			$this->page_name = (!empty($data['page_name'])) ? $data['page_name'] : null;
			$this->page_content = (!empty($data['page_content'])) ? $data['page_content'] : null;
		}
	}