<?php

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "frobi-online-examination");

class Questions{
	private $m_sqli;	
	private $m_lastSetId;
	
	public function __construct(){		
		$this->m_sqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
		if ($this->m_sqli->connect_error)
			trigger_error('Connect Error: ' . $this->m_sqli->connect_error);
	}
	
	public function __destruct(){
		$this->m_sqli->close();
	}
	
	public function NewQuestionSet(string $imagefolder){
		$mysqli = $this->m_sqli;

		if ($stmt = $mysqli->prepare('INSERT INTO question_sets(imagesfolder) VALUES(?)')){
			$stmt->bind_param('s', $imagefolder);
			$stmt->execute();				
			$this->m_lastSetId = $stmt->insert_id;
			$stmt->close();	
		}
		
		$res->close();
	}
	
	public function GetLastSetId() { return $this->m_lastSetId; }
	
	public function AddQuestion(int $setid, int $sn, string $question, string $optiona, string $optionb, string $optionc, string $optiond){
		$mysqli = $this->m_sqli;

		if ($stmt = $mysqli->prepare('INSERT INTO questions(setid, sn, question, optiona, optionb, optionc, optiond) VALUES(?, ?, ?, ?, ?, ?, ?)')){
			$stmt->bind_param('iisssss', $setid, $sn, $question, $optiona, $optionb, $optionc, $optiond);
			$stmt->execute();				
			$stmt->close();	
		}
		
		$res->close();
	}
	
	public function UpdateQuestion(int $setid, int $sn, string $question, string $optiona, string $optionb, string $optionc, string $optiond){
		$mysqli = $this->m_sqli;
				
		if ($stmt = $mysqli->prepare('UPDATE questions SET question=?, optiona=?, optionb=?, optionc=?, optiond=? WHERE setid=? AND $sn=?')){
			$stmt->bind_param('sssssii', $question, $optiona, $optionb, $optionc, $optiond, $setid, $sn);
			$stmt->execute();
			$stmt->close();
		}
	}
}

?>