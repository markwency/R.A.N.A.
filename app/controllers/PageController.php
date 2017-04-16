<?php

class PageController extends Controller{

	function home(){

		//$this->f3->clear("SESSION");

		//var_dump($this->f3->get("SESSION"));

		$this->f3->set('title', "Retrieval");
		echo Template::instance()->render($this->f3->get('VIEWS').'index.htm');

	}

	function retrieveSLB(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify');

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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){

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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){
		    		
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
	
		echo json_encode("SLB Done.");	
	}

	function retrieveSA(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify');

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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){

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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){
		    		
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
	
		echo json_encode("SA Done.");	
	}


	function retrieveClosing(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify');

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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){

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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){
		    		
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
	
		echo json_encode("Closing done.");	
	}

	function retrieveCashLoan(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify');

		$collectionCashLoan = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 3){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionCashLoan, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionCashLoan = array_map('strtolower', $collectionCashLoan);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionCashLoan as $key => $value){
		   $collectionCashLoan[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("CashLoan.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionCashLoan as $string) {

		    foreach($features as $feature){
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){

		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionCashLoan as $str1){
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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){
		    		
		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionCashLoan as $str1){
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
	
		echo json_encode("Cash Loan done.");	
	}

	function retrieveOSAM(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify');

		$collectionOSAM = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 4){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionOSAM, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionOSAM = array_map('strtolower', $collectionOSAM);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionOSAM as $key => $value){
		   $collectionOSAM[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("OSAM.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionOSAM as $string) {

		    foreach($features as $feature){
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){

		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionOSAM as $str1){
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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){
		    		
		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionOSAM as $str1){
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
	
		echo json_encode("OSAM Done.");	
	}

	function retrieveRegistration(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify');

		$collectionRegistration = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 5){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionRegistration, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionRegistration = array_map('strtolower', $collectionRegistration);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionRegistration as $key => $value){
		   $collectionRegistration[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("Registration.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionRegistration as $string) {

		    foreach($features as $feature){
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){

		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionRegistration as $str1){
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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){
		    		
		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionRegistration as $str1){
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
	
		echo json_encode("Registration Done.");	
	}

	function retrieveStudentActivity(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify');

		$collectionActivity = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 6){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionActivity, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionActivity = array_map('strtolower', $collectionActivity);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionActivity as $key => $value){
		   $collectionActivity[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("StudentAct.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionActivity as $string) {

		    foreach($features as $feature){
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){

		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionActivity as $str1){
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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){
		    		
		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionActivity as $str1){
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
	
		echo json_encode("Student Activity Done.");	
	}

	function retrieveScholarship(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify');

		$collectionScholarship = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 7){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionScholarship, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionScholarship = array_map('strtolower', $collectionScholarship);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionScholarship as $key => $value){
		   $collectionScholarship[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("Scholarship.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionScholarship as $string) {

		    foreach($features as $feature){
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){

		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionScholarship as $str1){
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
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){
		    		
		    		$tf1 = substr_count($string, $feature);
		    		$tf2 = str_word_count($string);
		    		
		    		if($tf2 != 0){
		    			$tf = $tf1/$tf2;
		    		}else{
		    			$tf = 0;
		    		}

		    		$idf1 = $count;
					$idf2 = 0;
		    		
		    		foreach($collectionScholarship as $str1){
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
	
		echo json_encode("Scholarship Done.");	
	}

	function createTestData(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify');

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


		$test = array('ano po yung scholarships offered', 'ano po ung iskolar ng bayan act');

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
		    
		    $txt = "+1 ";
		    fwrite($myfile2, $txt);
		    
		    foreach($features as $feature){
		    	
		    	$reg = "~\b".$feature."\b~";
		    	if (preg_match($reg,$string)){

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
	
		echo json_encode("Test Data created.");	
	}

}


?>