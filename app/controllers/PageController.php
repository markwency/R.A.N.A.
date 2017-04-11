<?php

class PageController extends Controller{

	function home(){

		//$this->f3->clear("SESSION");

		//var_dump($this->f3->get("SESSION"));

		$this->f3->set('title', "Retrieval");
		echo Template::instance()->render($this->f3->get('VIEWS').'index.htm');

	}

	function retrieve(){

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load(array('direction=?', 'i'));

		while(!$im->dry()){	//request already exists

			$count++;
			$im->next();
		
		}
		
		echo json_encode($count);
		
		
	}

}


?>