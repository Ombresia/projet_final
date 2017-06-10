<?php

require_once ('database.php');
/**
 * Created by PhpStorm.
 * Date: 6/3/2017
 * Time: 2:56 PM
 */
class articles
{
    private $title;
    private $id;
    private $body;
    private $db;
    private $database;
    private $category_id;
    private $artist_id;

    function __construct ()
    {
        $this->database = new Database();
        $this->db = $this->database->connect();
    }

    /**
     * @param $title : title of the article
     * @param $body : content of the article
     * @param $category_id : id of the category
     * @param $artist_id : id of the artist
     * @return bool : return false if parameters not set of statement failed
     *                return true is the artist is created successfully
     */
    function CreateArticle($title, $body, $category_id, $artist_id){
        if (isset($title) && isset($body) && isset($category)){
            $this->title = $title;
            $this->category_id = $category_id;
            $this->artist_id = $artist_id;
            $this->body = $body;
            $stmt = $this->db->prepare("INSERT INTO ARTICLES
                                        (TITLE,
                                         BODY,
                                         CREATED,
                                         id_cat,
                                         id_artist)
                                         VALUES
                                         (?,?,?,?,?)");

            $stmt->bind_param('sssii',
                                $this->title,
                                $this->body,
                                time(),
                                $this->category_id,
                                $this->artist_id);

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result){
                return false;
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $id : id of the article to delete
     * @return bool : return false if parameter not set or statement failed
     *                return true if statement completed successfully
     */
    function DeleteArticle($id){
        if(isset($id)){
            $this->id = $id;
            $stmt = $this->db->prepare("DELETE FROM ARTICLES
                                        WHERE ID = ?");
            $stmt->bind_param('i',$this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (!$result){
                return false;
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $id : if of the article to edit
     * @param $title : title of the article
     * @param $body : body of the article
     * @param $category_id : id of the category associated to the article
     * @param $artist_id : id of the article related to the article
     * @return bool : return false if parameters are not set or statement failed
     *                return true if the article has been successfully updated
     */
    function EditArticle($id, $title, $body, $category_id, $artist_id){
        if(isset($id) && isset($title) && isset($body) && isset($category_id) && isset($artist_id)){
            $this->id = $id;
            $this->title = $title;
            $this->body = $body;
            $this->category_id = $category_id;
            $this->artist_id = $artist_id;

            $stmt = $this->db->prepare("UPDATE ARTICLES
                                        SET 
                                        TITLE=?,
                                        BODY=?
                                        ID_CAT=?,
                                        ID_ARTIST=?
                                        WHERE
                                        ID = ?");
            $stmt->bind_param('ssiii',
                                $this->title,
                                $this->body,
                                $this->category_id,
                                $this->artist_id,
                                $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (!$result){
                return false;
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @return array|bool : return either false if statement failed or an array of results
     */
    function GetArticles(){
        $query = "SELECT * FROM ARTICLES";
        $this->db->set_charset("utf8");
        $result = $this->db->query($query);
        if (!$result){
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }


    /**
     * @param $id : id of the article to retrieve
     * @return array|bool : return either false if statement failed or parameter not set
     *                      return an array of results id statement is successful
     */
    function GetArticle($id){
        if (isset($id)) {
            $this->db->set_charset("utf8");
            $stmt = $this->db->prepare("SELECT * 
                                    FROM ARTICLES 
                                    WHERE ID = ?");
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (!$result) {
                return false;
            }
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        else
        {
            return false;
        }
    }






}