<?php
require_once 'database.php';

class Search {

	private $db;
	private $database;

	function __construct()
    {
		$this->database = new Database();
		$this->db = $this->database->connect();
    }

	/**
	 * search articles for matching words in the database
	 *
	 * @param $filter : string to search in the articles
	 * @return The result of the articles matching the search filter
	 */
    public function Articles($filter) {

    	$stmt = $this->db->prepare("SELECT title,body,created 
    								FROM articles 
    								WHERE MATCH(title,body) AGAINST(? IN NATURAL LANGUAGUE MODE)");
		$stmt->bind_param('s', $filter);		
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		if(!$result) {
			return false;
		}
		while ($row = $result -> fetch_assoc()) {
			$rows[] = $row;
		}
		return $rows;

    }

	/**
	 * search artworks for matching words in the database
	 *
	 * @param $filter : text to search
	 * @return array|bool : The result of the artworks matching the search filter
	 */
    public function Artworks($filter) {

    	$stmt = $this->db->prepare("SELECT art_title,art_description,date_created 
    								FROM artwork 
    								WHERE MATCH(art_title,art_description) AGAINST(? IN NATURAL LANGUAGUE MODE)");
		$stmt->bind_param('s', $filter);		
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		if(!$result) {
			return false;
		}
		while ($row = $result -> fetch_assoc()) {
			$rows[] = $row;
		}
		return $rows;

	}


	/**
	 * search artworks and articles matching words in the database
	 *
	 * @param $filter : text to search
	 * @return The result of the artworks and articles matching the search filter
	 */
    public function Everything($filter) {

    	$stmt = $this->db->prepare("SELECT title,body,created 
    								FROM artwork 
    								WHERE MATCH(art_title,art_description) AGAINST(? IN NATURAL LANGUAGUE MODE)
    								UNION 
    								SELECT title,body,created 
    								FROM articles 
    								WHERE MATCH(title,body) AGAINST(? IN NATURAL LANGUAGUE MODE)");
		$stmt->bind_param('ss', $filter, $filter);		
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		if($result === false) {
			return false;
		}
		while ($row = $result -> fetch_assoc()) {
			$rows[] = $row;
		}
		return $rows;

	}

	function __destruct()
    {
                
    }    

}