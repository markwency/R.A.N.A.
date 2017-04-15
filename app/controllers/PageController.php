<?php

class PageController extends Controller{

	function home(){

		//$this->f3->clear("SESSION");

		//var_dump($this->f3->get("SESSION"));

		$this->f3->set('title', "Retrieval");
		echo Template::instance()->render($this->f3->get('VIEWS').'index.htm');

	}

	function retrieveSLB(){

		$collectionSLB = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 2){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionSLB, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless');

		$collectionSLB = array_map('strtolower', $collectionSLB);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionSLB as $key => $value){
		   $collectionSLB[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("SLB.train", "w");
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
		    		
		    		foreach($collectionSLB as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		foreach($collection as $str1){
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

		foreach ($collection as $string) {
		    
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
		    		
		    		foreach($collectionSLB as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		foreach($collection as $str1){
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

		fclose($myfile);
	
		echo json_encode($count);	
	}

	function retrieveSA(){

		$collectionSA = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 1){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionSA, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless');


		$collectionSA = array_map('strtolower', $collectionSA);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionSA as $key => $value){
		   $collectionSA[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("SA.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionSA as $string) {

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

		    		foreach($collection as $str1){
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

		foreach ($collection as $string) {
		    
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

		    		foreach($collection as $str1){
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

		fclose($myfile);
	
		echo json_encode($count);	
	}


	function retrieveClosing(){

		$collectionClosing = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 17){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionClosing, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless');


		$collectionClosing = array_map('strtolower', $collectionClosing);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionClosing as $key => $value){
		   $collectionClosing[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("Closing.train", "w");
		$index = 1;
		$trigger = 0;
		
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
		    		
		    		foreach($collectionClosing as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		foreach($collection as $str1){
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

		foreach ($collection as $string) {
		    
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
		    		
		    		foreach($collectionClosing as $str1){
		    			$idf2 = $idf2 + substr_count($str1, $feature);
		    		}

		    		foreach($collection as $str1){
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

		fclose($myfile);
	
		echo json_encode($count);	
	}

	function createTestData(){

		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}


		$test = array('pwede ba magpasa ng late na dtr', 'delayed sa salary for month of november', 'how to generate dtr', 'meron pa po bang vacant positions for sa', 'how to apply for slb?', 'payment in landbank for student loan board', 'magkano po interest kapag 80% slb?', 'naayos ko na po. thank you very much!', 'okay. god bless and thank you!', 'ok. thanks po.', 'thanks osa!', 'maraming salamat!', 'thank you. more power :)'
		);

		/*$test = array('how to apply for slb?', 'naayos ko na po slb ko. thank you very much!', 'payment in landbank for student loan board', 'okay. god bless and thank you!', 'magkano po interest kapag 80% slb?', 'ok na po slb application ko. thanks po.'
		);*/

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless');


		$test = array_map('strtolower', $test);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($test as $key => $value){
		   $test[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile2 = fopen("testData.test", "w");
		$index = 1;
		$trigger = 0;

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

		    		foreach($collection as $str1){
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

		fclose($myfile2);
	
		echo json_encode($count);	
	}

}


?>