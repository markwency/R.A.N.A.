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
		$collectionClosing = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 2){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionSLB, $inquiry);
				$im->next();
			
			}else if($im->category == 17){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionClosing, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}


		/*$test = array('how to apply for slb?', 'payment in landbank for student loan board', 'magkano po interest kapag 80% slb?', 'deadline for sa application', 'delayed sa salary for month of november', 'how to generate dtr'
		);*/

		$test = array('how to apply for slb?', 'naayos ko na po slb ko. thank you very much!', 'payment in landbank for student loan board', 'okay. god bless and thank you!', 'magkano po interest kapag 80% slb?', 'ok na po slb application ko. thanks po.'
		);

		$features = array('SA', 'S.A.', 'vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'po', 'thanks', 'more', 'power', 'god', 'bless');


		$collectionSA = array_map('strtolower', $collectionSA);
		$collectionSLB = array_map('strtolower', $collectionSLB);
		$collectionClosing = array_map('strtolower', $collectionClosing);
		$features = array_map('strtolower', $features);

		foreach ($collectionSA as $key => $value){
		   $collectionSA[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", "."), "", $value);
		}

		foreach ($collectionSLB as $key => $value){
		   $collectionSLB[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", "."), "", $value);
		}

		foreach ($collectionClosing as $key => $value){
		   $collectionClosing[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", "."), "", $value);
		}

		foreach ($test as $key => $value){
		   $test[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", "."), "", $value);
		}


		$myfile = fopen("RANA.train", "w");
		$myfile2 = fopen("RANA.test", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionSLB as $string) {
		    
		    foreach($features as $feature){
		    	
		    	if (strpos($string, $feature) !== false){

		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
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

		    		$tfidf = $tf * $idf;

		    		if($tfidf != 0){
		    			if($trigger == 0){
			    			$trigger = 1;
		    				$txt = "+1 " . $index . ":" . $tfidf . " ";
		    			}else{
		    				$txt = $index . ":" . $tfidf . " ";
		    			}
		    			fwrite($myfile, $txt);
		    		}

		    	}
		    	
		    	$index++;
		    
		    }
		    if(!$trigger == 0){
				fwrite($myfile, "\r\n");
			}
			$index = 1;
			$trigger = 0;
		}

		foreach ($collectionClosing as $string) {
		    
		    foreach($features as $feature){
		    	
		    	if (strpos($string, $feature) !== false){
		    		
		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
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

		    		$tfidf = $tf * $idf;

		    		if($tfidf != 0){
		    			if($trigger == 0){
			    			$trigger = 1;
		    				$txt = "-1 " . $index . ":" . $tfidf . " ";
		    			}else{
		    				$txt = $index . ":" . $tfidf . " ";
		    			}
		    			fwrite($myfile, $txt);
		    		}

		    	}
		    	
		    	$index++;
		    
		    }
			if(!$trigger == 0){
				fwrite($myfile, "\r\n");
			}
			$index = 1;
			$trigger = 0;
		
		}

		foreach ($test as $string) {
		    
		    $txt = "0 ";
		    fwrite($myfile2, $txt);
		    
		    foreach($features as $feature){
		    	
		    	if (strpos($string, $feature) !== false){

		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
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

		    		$tfidf = $tf * $idf;

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