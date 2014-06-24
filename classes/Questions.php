<?php

if (!defined("HOST")){
	define("HOST", "localhost");
	define("USER", "root");
	define("PASSWORD", "");
	define("DATABASE", "frobi-online-examination");
}


class Questions{
	private $m_sqli;	
	private $m_lastSetId;
	private $imageroot;
	
	public function __construct(){		
		$this->m_sqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
		if ($this->m_sqli->connect_error)
			trigger_error('Connect Error: ' . $this->m_sqli->connect_error);
		$this->imageroot = $_SERVER['DOCUMENT_ROOT'].'online-examination\\images\\';
	}
	
	public function __destruct(){
		$this->m_sqli->close();
	}
			
	public function NewQuestionSet($imagefolder){
		$mysqli = $this->m_sqli;

		if ($stmt = $mysqli->prepare('INSERT INTO question_sets(imagesfolder) VALUES(?)')){
			$stmt->bind_param('s', $imagefolder);
			$stmt->execute();				
			$this->m_lastSetId = $stmt->insert_id;
			$stmt->close();	
		}
		mkdir($this->imageroot.$imagefolder);
	}
	
	public function GetLastSetId() { return $this->m_lastSetId; }
	public function GetNumSets()
	{
		$mysqli = $this->m_sqli;
		if ($res=$mysqli->query('SELECT * FROM question_sets')){
			return $res->num_rows;
		}
		return 0;
	} 
	public function PrintQuestionSets(){
		$mysqli = $this->m_sqli;
		if ($res = $mysqli->query('SELECT setid FROM question_sets')){
			while($row = $res->fetch_assoc()){
				echo $row['setid'] . '<br/>';
			}
		}
	}
	public function GetNumQuestions($setid)
	{
		$nqns=0;
		$mysqli = $this->m_sqli;
		if ($stmt=$mysqli->prepare('SELECT * FROM questions WHERE setid=?')){
			$stmt->bind_param('i', $setid);
			$stmt->execute(); 
			$stmt->store_result();
			$nqns = $stmt->num_rows;
			$stmt->close();
		}
		return $nqns;
	}
	public function EchoQuestion($setid, $qsn)
	{
		$mysqli = $this->m_sqli;;
		if ($stmt=$mysqli->prepare('SELECT question FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $qsn);
			$stmt->execute(); 
			$stmt->store_result();
			$stmt->bind_result($question);
			if ($stmt->fetch())
				echo $question;
			$stmt->close();
		}
	}
	public function EchoOpta($setid, $qsn)
	{
		$mysqli = $this->m_sqli;;
		if ($stmt=$mysqli->prepare('SELECT optiona FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $qsn);
			$stmt->execute(); 
			$stmt->store_result();
			$stmt->bind_result($optiona);
			if ($stmt->fetch())
				echo $optiona;
			$stmt->close();
		}
	}
	public function EchoOptb($setid, $qsn)
	{
		$mysqli = $this->m_sqli;;
		if ($stmt=$mysqli->prepare('SELECT optionb FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $qsn);
			$stmt->execute(); 
			$stmt->store_result();
			$stmt->bind_result($optionb);
			if ($stmt->fetch())
				echo $optionb;
			$stmt->close();
		}
	}
	public function EchoOptc($setid, $qsn)
	{
		$mysqli = $this->m_sqli;;
		if ($stmt=$mysqli->prepare('SELECT optionc FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $qsn);
			$stmt->execute(); 
			$stmt->store_result();
			$stmt->bind_result($optionc);
			if ($stmt->fetch())
				echo $optionc;
			$stmt->close();
		}
	}
	public function EchoOptd($setid, $qsn)
	{
		$mysqli = $this->m_sqli;;
		if ($stmt=$mysqli->prepare('SELECT optiond FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $qsn);
			$stmt->execute(); 
			$stmt->store_result();
			$stmt->bind_result($optiond);
			if ($stmt->fetch())
				echo $optiond;
			$stmt->close();
		}
	}
	
	public function GetQuestion($setid, $qsn, &$question, &$optiona, &$optionb, &$optionc, &$optiond){
		$mysqli = $this->m_sqli;
		if ($stmt=$mysqli->prepare('SELECT question, optiona, optionb, optionc, optiond FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $qsn);
			$stmt->execute(); 
			$stmt->store_result();
			$stmt->bind_result($q, $oa, $ob, $oc, $od);
			if ($stmt->fetch()){
				$question=$q;
				$optiona=$oa;
				$optionb=$ob;
				$optionc=$oc;
				$optiond=$od;
			}
			$stmt->close();
		}
	}
	
	public function AddQuestion($setid, $sn, $question, $optiona, $optionb, $optionc, $optiond){
		$mysqli = $this->m_sqli;

		if ($stmt = $mysqli->prepare('INSERT INTO questions(setid, sn, question, optiona, optionb, optionc, optiond) VALUES(?, ?, ?, ?, ?, ?, ?)')){
			$stmt->bind_param('iisssss', $setid, $sn, $question, $optiona, $optionb, $optionc, $optiond);
			$stmt->execute();				
			$stmt->close();	
			echo 'Added Successfully';
		}
	}
	
	public function UpdateQuestion($setid, $sn, $question, $optiona, $optionb, $optionc, $optiond){
		$mysqli = $this->m_sqli;
				
		if ($stmt = $mysqli->prepare('UPDATE questions SET question=?, optiona=?, optionb=?, optionc=?, optiond=? WHERE setid=? AND $sn=?')){
			$stmt->bind_param('sssssii', $question, $optiona, $optionb, $optionc, $optiond, $setid, $sn);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	public function GetPassage($setid, $sn)
	{
		$mysqli = $this->m_sqli;
		if ($stmt = $mysqli->prepare('SELECT qid FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $sn);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($qid);
			if ($stmt->fetch()){			
				if ($stmt1 = $mysqli->prepare('SELECT passage FROM passages WHERE qid=?')){
					$stmt1->bind_param('i', $qid);
					$stmt1->execute();	
					$stmt1->store_result();
					$stmt1->bind_result($passage);					
					if ($stmt1->fetch()){
						return $passage;
					}		
					$stmt1->close();
				}	
			}		
			$stmt->close();
		}
		return "";
	}
	
	public function AddPassage($setid, $sn, $passage)
	{
		$mysqli = $this->m_sqli;
		if ($stmt = $mysqli->prepare('SELECT qid FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $sn);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($qid);
			if ($stmt->fetch()){			
				if ($stmt1 = $mysqli->prepare('INSERT INTO passages(qid,passage) VALUES(?,?)')){
					$stmt1->bind_param('is', $qid, $passage);
					$stmt1->execute();	
					$stmt1->close();
				}	
			}		
			$stmt->close();
		}
		return "";
	}	
	
	public function DeleteImages($setid, $qsn) {
		$mysqli = $this->m_sqli;
		
		if ($stmt = $mysqli->prepare('SELECT imagesfolder FROM question_sets WHERE setid=?')){
			$stmt->bind_param('i', $setid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($imagesfolder);
			if ($stmt->fetch()){
				foreach (glob($this->imageroot.$imagesfolder.'\\'.$qsn.'x*.png') as $filename) {
				   unlink($filename);
				}				
			}
			$stmt->close();
		}
	}
	
	public function AddUploadedImage($setid){
		$mysqli = $this->m_sqli;
		
		if ($stmt = $mysqli->prepare('SELECT imagesfolder FROM question_sets WHERE setid=?')){
			$stmt->bind_param('i', $setid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($imagesfolder);
			if ($stmt->fetch()){
				$uploadfile = $this->imageroot.$imagesfolder."\\".basename($_FILES['file']['name']);
		        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
			}
			$stmt->close();
		}
	}
	
	public function AddAnswer($userid, $setid, $qsn, $option){
		$mysqli = $this->m_sqli;
		if ($stmt = $mysqli->prepare('SELECT qid FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $qsn);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($qid);
			if ($stmt->fetch()){			
				if ($stmt1 = $mysqli->prepare('SELECT * FROM answers WHERE qid=? AND userid=?')){
					$stmt1->bind_param('ii', $qid, $userid);
					$stmt1->execute();	
					$stmt1->store_result();
					
					if ($stmt1->num_rows > 0){
						if ($stmt2 = $mysqli->prepare('UPDATE answers SET ans=? WHERE qid=? AND userid=?')){
							$stmt2->bind_param('iii', $option, $qid, $userid);
							$stmt2->execute();
							$stmt2->close();
						}
					}
					else{
						if ($stmt2 = $mysqli->prepare('INSERT INTO answers(userid, qid, ans) VALUES(?,?,?)')){
							$stmt2->bind_param('iii', $userid, $qid, $option);
							$stmt2->execute();
							$stmt2->close();
						}
					}				
					$stmt1->close();
				}	
			}		
			$stmt->close();
		}
	}
	
	public function GetAnswer($userid, $setid, $qsn){
		$mysqli = $this->m_sqli;
		
		if ($stmt = $mysqli->prepare('SELECT qid FROM questions WHERE setid=? AND sn=?')){
			$stmt->bind_param('ii', $setid, $qsn);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($qid);
			if ($stmt->fetch()){			
				if ($stmt1 = $mysqli->prepare('SELECT ans FROM answers WHERE qid=? AND userid=?')){
					$stmt1->bind_param('ii', $qid, $userid);
					$stmt1->execute();	
					$stmt1->store_result();
					$stmt1->bind_result($option);
					if ($stmt1->fetch())
						return $option;
						
					$stmt1->close();
				}							
			}
			$stmt->close();
				
		}
		return -1;	
	}
	
	public function StartExam(){
		$mysqli = $this->m_sqli;
		
		date_default_timezone_set("Asia/Kathmandu");
		$time = date( 'Y-m-d H:i:s',time());
		if ($res = $mysqli->query('UPDATE users SET exam_start_time ="'.$time.'"')){
			echo $time;
		}
	}
}

?>