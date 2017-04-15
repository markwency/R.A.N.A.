<?php

class PageController extends Controller{

	function home(){

		//$this->f3->clear("SESSION");

		//var_dump($this->f3->get("SESSION"));

		$this->f3->set('title', "Retrieval");
		echo Template::instance()->render($this->f3->get('VIEWS').'index.htm');

	}

	function retrieve(){

		$collectionSA = []; 
		$collectionSLB = []; 

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 1){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionSA, $inquiry);
				$im->next();
			
			}else if($im->category == 2){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionSLB, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$test = array('how to apply for slb?', 'payment in landbank for student loan board', 'magkano po interest kapag 80% slb?', 'deadline for sa application', 'delayed sa salary for month of november', 'how to generate dtr'
		);

		$features = array('S.A.','SA','vacant','position','positions','apply','form','3b','3c','units','orientation','generate','DTR','student','assistant','assistantship','application','submit','late','salary','diff','differential','landbank','bank','account','atm','card','claiming','max','maximum','hours','midyear','canceled','work','sweldo','personal','opening','slots','payroll','underload','daily','time','record','appointment','reset','schedule','5th','working','day','allowance','SLB','student','loan','board','deadline','generate','application','form','loan','flow','process','co-debtor','certification','scanned','photocopy','valid','id','100%','student','loan','graduate','remaining','balance','payment','bank','transactions','due','date','installments','magkano','bayad','interest','computation');

		$collectionSA = array_map('strtolower', $collectionSA);
		$collectionSLB = array_map('strtolower', $collectionSLB);
		$features = array_map('strtolower', $features);

		foreach ($collectionSA as $key => $value){
		   $collectionSA[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", "."), "", $value);
		}

		foreach ($collectionSLB as $key => $value){
		   $collectionSLB[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", "."), "", $value);
		}

		foreach ($test as $key => $value){
		   $test[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", "."), "", $value);
		}


		$myfile = fopen("SA.train", "w");
		$myfile2 = fopen("SA.test", "w");
		$index = 1;
		
		foreach ($collectionSA as $string) {
		    
		    $txt = "+1 ";
		    fwrite($myfile, $txt);
		    
		    foreach($features as $feature){
		    	
		    	if (strpos($string, $feature) !== false){

		    		$tfidf = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		/*if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionSA as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		foreach($collectionSLB as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		if($idf2 != 0){
		    			$idf = log($idf1/$idf2);
		    		}else{
		    			$idf = 0;
		    		}

		    		$tfidf = $tf * $idf;*/

		    		if($tfidf != 0){
		    			$txt = $index . ":" . $tfidf . " ";
		    			fwrite($myfile, $txt);
		    		}

		    	}
		    	
		    	$index++;
		    
		    }
			fwrite($myfile, "\r\n");
			$index = 1;
		
		}

		foreach ($collectionSLB as $string) {
		    
		    $txt = "-1 ";
		    fwrite($myfile, $txt);
		    
		    foreach($features as $feature){
		    	
		    	if (strpos($string, $feature) !== false){
		    		
		    		$tfidf = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		/*if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionSA as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		foreach($collectionSLB as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		if($idf2 != 0){
		    			$idf = log($idf1/$idf2);
		    		}else{
		    			$idf = 0;
		    		}

		    		$tfidf = $tf * $idf;*/

		    		if($tfidf != 0){
		    			$txt = $index . ":" . $tfidf . " ";
		    			fwrite($myfile, $txt);
		    		}

		    	}
		    	
		    	$index++;
		    
		    }
			fwrite($myfile, "\r\n");
			$index = 1;
		
		}

		foreach ($test as $string) {
		    
		    $txt = "-1 ";
		    fwrite($myfile2, $txt);
		    
		    foreach($features as $feature){
		    	
		    	if (strpos($string, $feature) !== false){

		    		$tfidf = substr_count($string, $feature);
		    		/*$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionSA as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		foreach($collectionSLB as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		if($idf2 != 0){
		    			$idf = log($idf1/$idf2);
		    		}else{
		    			$idf = 0;
		    		}

		    		$tfidf = $tf * $idf;*/

		    		if($tfidf != 0){
		    			$txt = $index . ":" . $tfidf . " ";
		    			fwrite($myfile2, $txt);
		    		}

		    	}
		    	
		    	$index++;
		    
		    }
			fwrite($myfile2, "\r\n");
			$index = 1;
		
		}

		fclose($myfile);
		fclose($myfile2);

		echo json_encode($count);
		
	}

}


?>