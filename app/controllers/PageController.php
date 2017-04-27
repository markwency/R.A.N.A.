<?php

class PageController extends Controller{

	function home(){

		//$this->f3->clear("SESSION");

		//var_dump($this->f3->get("SESSION"));

		$this->f3->set('title', "Retrieval");
		echo Template::instance()->render($this->f3->get('VIEWS').'index.htm');

	}

	function retrieveSLB(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

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

		$argument = "-g 0.001953125 -c 8192 SLB.train";
		exec("svm-train $argument");

		echo json_encode("SLB Done.");	
	}

	function retrieveSA(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

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
	
		$argument = "-g 0.125 -c 2048 SA.train";
		exec("svm-train $argument");

		echo json_encode("SA Done.");	
	}


	function retrieveClosing(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

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
	
		$argument = "-g 0.001953125 -c 8192 Closing.train";
		exec("svm-train $argument");

		echo json_encode("Closing done.");	
	}

	function retrieveCashLoan(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

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
	
		$argument = "-t 0 -g 8 -c 128 CashLoan.train";
		exec("svm-train $argument");

		echo json_encode("Cash Loan done.");	
	}

	function retrieveOSAM(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

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
	
		$argument = "-t 0 -g 2 -c 32 OSAM.train";
		exec("svm-train $argument");

		echo json_encode("OSAM Done.");	
	}

	function retrieveRegistration(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

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
	
		$argument = "-t 0 -g 0.5 -c 128 Registration.train";
		exec("svm-train $argument");

		echo json_encode("Registration Done.");	
	}

	function retrieveStudentActivity(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

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
	
		$argument = "-g 0.125 -c 2048 StudentAct.train";
		exec("svm-train $argument");

		echo json_encode("Student Activity Done.");	
	}

	function retrieveScholarship(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

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
	
		$argument = "-t 0 -g 8 -c 8 Scholarship.train";
		exec("svm-train $argument");

		echo json_encode("Scholarship Done.");	
	}

	function retrieveSTS(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

		$collectionSTS = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 8){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionSTS, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionSTS = array_map('strtolower', $collectionSTS);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionSTS as $key => $value){
		   $collectionSTS[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("STS.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionSTS as $string) {

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
		    		
		    		foreach($collectionSTS as $str1){
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
		    		
		    		foreach($collectionSTS as $str1){
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
	
		$argument = "-g 0.0078125 -c 8192 STS.train";
		exec("svm-train $argument");

		echo json_encode("STS Done.");	
	}

	function retrieveCounsel(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');
		$collectionCounsel = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 9){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionCounsel, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionCounsel = array_map('strtolower', $collectionCounsel);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionCounsel as $key => $value){
		   $collectionCounsel[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("Counsel.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionCounsel as $string) {

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
		    		
		    		foreach($collectionCounsel as $str1){
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
		    		
		    		foreach($collectionCounsel as $str1){
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
	
		$argument = "-t 0 -g 0.0078125 -c 128 Counsel.train";
		exec("svm-train $argument");

		echo json_encode("Counsel Done.");	
	}

	function retrieveSchoolDays(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

		$collectionSchoolDays = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 10){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionSchoolDays, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionSchoolDays = array_map('strtolower', $collectionSchoolDays);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionSchoolDays as $key => $value){
		   $collectionSchoolDays[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("SchoolDays.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionSchoolDays as $string) {

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
		    		
		    		foreach($collectionSchoolDays as $str1){
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
		    		
		    		foreach($collectionSchoolDays as $str1){
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
	
		$argument = "-t 0 -g 0.5 -c 8 SchoolDays.train";
		exec("svm-train $argument");

		echo json_encode("School Days Done.");	
	}

	function retrieveSAIS(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

		$collectionSAIS = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 11){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionSAIS, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionSAIS = array_map('strtolower', $collectionSAIS);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionSAIS as $key => $value){
		   $collectionSAIS[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("SAIS.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionSAIS as $string) {

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
		    		
		    		foreach($collectionSAIS as $str1){
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
		    		
		    		foreach($collectionSAIS as $str1){
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
	
		$argument = "-g 0.0078125 -c 0.03125 SAIS.train";
		exec("svm-train $argument");

		echo json_encode("SAIS Done.");	
	}

	function retrieveAcad(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

		$collectionAcad = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 12){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionAcad, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionAcad = array_map('strtolower', $collectionAcad);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionAcad as $key => $value){
		   $collectionAcad[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("Acad.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionAcad as $string) {

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
		    		
		    		foreach($collectionAcad as $str1){
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
		    		
		    		foreach($collectionAcad as $str1){
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
	
		$argument = "-t 1 -g 0.5 -c 8 Acad.train";
		exec("svm-train $argument");

		echo json_encode("Acad Related Done.");	
	}

	function retrieveOther(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

		$collectionOther = []; 
		$collection = [];

		$count = 0;

		$im = new InquiriesMapper($this->db);
		
		$im->load();

		while(!$im->dry()){

			if($im->category == 18){
			
				$count++;
				$inquiry = $im->inquiry;
				array_push($collectionOther, $inquiry);
				$im->next();
			
			}else if($im->category != 13 || $im->category != 19){
				
				$count++;
				$inquiry = $im->inquiry;
				array_push($collection, $inquiry);
				$im->next();
			
			}
		
			$im->next();

		}

		$collectionOther = array_map('strtolower', $collectionOther);
		$collection = array_map('strtolower', $collection);
		$features = array_map('strtolower', $features);

		foreach ($collectionOther as $key => $value){
		   $collectionOther[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		foreach ($collection as $key => $value){
		   $collection[$key]  = str_replace(array("?", "!", ",", ";", "<", ">", ".", "(", ")"), "", $value);
		}

		$myfile = fopen("Other.train", "w");
		$index = 1;
		$trigger = 0;
		
		foreach ($collectionOther as $string) {

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
		    		
		    		foreach($collectionOther as $str1){
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
		    		
		    		foreach($collectionOther as $str1){
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
	
		$argument = "-g 8 -c 2 Other.train";
		exec("svm-train $argument");

		echo json_encode("Other inquiries Done.");	
	}


	function createTestData(){

		$features = array('sa','vacant', 'position', 'positions', 'apply', '3b', '3c', 'units', 'orientation', 'generate', 'DTR', 'student', 'assistant', 'assistantship', 'submit', 'late', 'salary', 'diff', 'differential', 'landbank', 'bank', 'account', 'atm', 'card', 'claiming', 'max', 'maximum', 'hours', 'midyear', 'canceled', 'work', 'sweldo', 'personal', 'opening', 'slots', 'payroll', 'underload', 'daily', 'time', 'record', 'appointment', 'reset', 'schedule', '5th', 'working', 'day', 'allowance', 'SLB', 'student', 'loan', 'board', 'deadline', 'application', 'form', 'flow', 'process', 'co-debtor', 'certification', 'scanned', 'photocopy', 'valid', 'id', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '100%', 'graduate', 'remaining', 'balance', 'payment', 'transactions', 'due', 'date', 'installments', 'magkano', 'bayad', 'interest', 'computation', 'okay', 'ok', 'thank', 'you', 'very', 'much', 'so', 'maraming', 'salamat', 'thanks', 'more', 'power', 'god', 'bless', 'cash', 'loan', 'apply', 'emergency', 'access', 'osam', 'website', 'temporary', 'account', 'acc', 'acct', 'password', 'information', 'profile', 'clearance', 'number', 'update', 'registration', 'period', 'extended', 'extension', 'extend', 'online', 'enlistment', 'matriculation', 'fee', 'promissory', 'note', 'letter', 'checks', 'tuition', 'readmission', 'organization', 'org', 'adviser', 'recognition', 'recog', 'activity', 'permit', 'campus', 'tour', 'volunteer', 'scholarship', 'scholar', 'scholarship', 'offer', 'offered', 'iskolar', 'bayan', 'act', 'qualify', 'sts', 'summer', 'scheduled', 'interview', 'appeal', 'pin', 'lost', 'results', 'refund', 'bracket', 'change', 'stipend', 'psychological', 'counseling', 'testing', 'psychologist', 'classes', 'suspended', 'today', 'academic', 'calendar', 'pasok', 'suspension', 'governor', 'memo', 'SAIS', 'upsais', 'courses', 'username', 'removals', 'removal', 'exam', 'exams', 'final', 'finals', 'mail', 'upmail', 'itc', 'our', 'exchange', 'programs', 'feb', 'fair', 'usc');

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


		$test = array('where can i get the activity permit for my organization');

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

		$results = [];
		
		$argument = "testData.test SA.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test SLB.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test CashLoan.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test OSAM.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test Registration.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test StudentAct.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test Scholarship.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test STS.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test Counsel.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test SchoolDays.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test SAIS.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test Acad.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test Closing.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$argument = "testData.test Other.train.model result.out";
		exec("svm-predict.exe $argument");
		$class = file_get_contents('result.out');
		array_push($results, $class);

		$flag = 0;
		$index = 0;

		foreach ($results as $classification) {
	
			if($classification == 1){
				
				$flag = 1;	
				if($index == 0){
					echo json_encode("SA");
				}
				if($index == 1){
					echo json_encode("SLB");
				}
				if($index == 2){
					echo json_encode("Cash Loan");
				}
				if($index == 3){
					echo json_encode("OSAM");
				}
				if($index == 4){
					echo json_encode("Registration");
				}
				if($index == 5){
					echo json_encode("Student Activity");
				}
				if($index == 6){
					echo json_encode("Scholarship");
				}
				if($index == 7){
					echo json_encode("STS");
				}
				if($index == 8){
					echo json_encode("Counseling");
				}
				if($index == 9){
					echo json_encode("School Days");
				}
				if($index == 10){
					echo json_encode("SAIS");
				}
				if($index == 11){
					echo json_encode("Academic Related");
				}
				if($index == 12){
					echo json_encode("Closing");
				}
				if($index == 13){
					echo json_encode("Other Offices");
				}
	
			}
			
			$index++;

		}

		if($flag == 0){

			echo json_encode("No category.");
		
		}
	}

}


?>