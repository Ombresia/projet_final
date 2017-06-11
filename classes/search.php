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
        $this->db->set_charset("utf8");
    	$stmt = $this->db->prepare("SELECT id,title,body,created 
    								FROM articles 
    								WHERE MATCH(title,body) AGAINST(? IN BOOLEAN MODE)");
		$stmt->bind_param('s', $filter);		
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		if(!$result) {
			return false;
		}
        if(!$result->num_rows == 0){
            while ($row = $result -> fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        return "no_result";
    }

	/**
	 * search artworks for matching words in the database
	 *
	 * @param $filter : text to search
	 * @return array|bool : The result of the artworks matching the search filter
	 */
    public function Artworks($filter) {
        $this->db->set_charset("utf8");
    	$stmt = $this->db->prepare("SELECT id,art_title,art_description,date_created 
    								FROM artwork 
    								WHERE MATCH(art_title,art_description) AGAINST(? IN BOOLEAN MODE)");
		$stmt->bind_param('s', $filter);		
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		if(!$result) {
			return false;
		}
		if(!$result->num_rows == 0){
            while ($row = $result -> fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
		}
        return "no_result";
	}


	/**
	 * search artworks and articles matching words in the database
	 *
	 * @param $filter : text to search
	 * @return The result of the artworks and articles matching the search filter
	 */
    public function Everything($filter) {

        $this->db->set_charset("utf8");
    	$stmt = $this->db->prepare("SELECT id,art_title,art_description,date_created 
    								FROM artwork 
    								WHERE MATCH(art_title,art_description) AGAINST(? IN BOOLEAN MODE)
    								UNION 
    								SELECT id,title,body,created 
    								FROM articles 
    								WHERE MATCH(title,body) AGAINST(? IN BOOLEAN MODE)");
		$stmt->bind_param('ss', $filter, $filter);		
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		if($result === false) {
			return false;
		}
        if(!$result->num_rows == 0){
            while ($row = $result -> fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        return [];

	}

	function __destruct()
    {
                
    }    

}