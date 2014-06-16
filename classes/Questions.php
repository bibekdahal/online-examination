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
		$this->m_sqli->query('CREATE TABLE IF NOT EXISTS question_sets(setid int auto_increment, tablename varchar(100), primary key(setid))');
	}
	
	public function __destruct(){
		$this->m_sqli->close();
	}
	
	public function NewQuestionSet(int $numberOfQuestions){
		$mysqli = $this->m_sqli;
		
		if ($result = $mysqli->query('SELECT * FROM question_sets')){
			$nsets = $result->num_rows;
			$newname = "question".$nsets;
			if ($res = $mysqli->query('CREATE TABLE '.$newname.'(id int auto_increment, question mediumtext, optiona mediumtext, optionb mediumtext, optionc mediumtext, optiond mediumtext, primary key(id))')){
				for ($i=0; $i<$numberOfQuestions; $i++)
					$mysqli->query('INSERT INTO '.$newname.' VALUES('.($i+1).', " ", " ", " ", " ")');
				
				if ($stmt1 = $mysqli->prepare('INSERT INTO question_sets(tablename) VALUES(?)')){
					$stmt1->bind_param('s', $newname);
					$stmt1->execute();
					$stmt1->close();
				}
				$this->m_lastSetId = $stmt->insert_id;
				
				$res->close();
			}
			$result->close();
		}
	}
	
	public function UpdateQuestion(int $setIndex, int $questionIndex, 
	string $question, string $optiona, string $optionb, string $optionc, string $optiond){
		$mysqli = $this->m_sqli;
				
		if ($stmt = $mysqli->prepare('SELECT tablename FROM question_sets WHERE setid=?')){
			$stmt->bind_param('i', $setIndex);
			$stmt->excute();
			$stmt->bind_result($tablename);
			
			if ($stmt->fetch())
			{
				if ($stmt1 = $mysqli->prepare('UPDATE '.$tablename.' SET question=?,optiona=?,optionb=?,optionc=?,optiond=? WHERE id=?'))
				{
					$stmt1->bind_param('sssssi', $question, $optiona, $optionb, $optionc, $optiond, $questionIndex);
					$stmt1->execute();
					$stmt1->close();
				}
			}
			
			$stmt->close();
		}
	}
}

?>