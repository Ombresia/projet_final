<?php

require_once ('database.php');
/**
 * Created by PhpStorm.
 * Date: 6/3/2017
 * Time: 2:05 PM
 */
class Comment
{
    private $id;
    private $comment;
    private $comment_type;
    private $comment_title;
    private $username;
    private $db;
    private $database;

    function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->connect();
    }

    /**
     * @param $id : id of the artwork or article
     * @param $username : username of person commenting
     * @param $comment_title : title of the comment
     * @param $comment : comment text
     * @param $comment_type : comment type, either artwork or articles
     * @return bool : if parameters missing or error on insert return false,
     *                if everything went fine, return true
     */
    function CreateComment($id, $username, $comment_title, $comment, $comment_type){
        if (isset($username) && isset($comment) && isset($comment_type) && isset($comment_title)) {
            $this->id = $id;
            $this->comment = $comment;
            $this->comment_type = $comment_type;
            $this->comment_title = $comment_title;
            $this->username = $username;
            $stmt = $this->db->prepare("INSERT INTO COMMENTS
    								    (COM_USERNAME,
    								     COM_TITLE,
    								     COM_BODY,
    								     COM_DATE,
    								     COM_TYPE,
    								     FK_ID)
    								     VALUES
    								     (?,?,?,?,?,?)");
            $stmt->bind_param('sssssi',
                              $this->username,
                              $this->comment_title,
                              $this->comment,
                              $this->time(),
                              $this->comment_type,
                              $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result) {
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
     * @param $id : id of the artwork or article
     * @param $comment_type : type of comment to filter
     * @return mixed : if parameters missing or error on insert return false,
     *                 else return corresponding rows
     */
    function GetComments($id,$comment_type){
        if (isset($id) && isset($comment_type)){
            $this->id = $id;
            $this->comment_type = $comment_type;
            $this->db->set_charset("utf8");
            $stmt = $this->db->prepare("SELECT 
                                        COM_USERNAME,
    								    COM_TITLE,
    								    COM_BODY,
    								    COM_DATE,
    								    COM_TYPE
    								    FROM COMMENTS
    								    WHERE id =?
    								    AND COMMENT_TYPE=?
    								    AND APPROVED=?");

            $stmt->bind_param('iss',$this->id,
                                    $this->comment_type,
                                    'Y');
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
        else
        {
            return false;
        }
    }

    /**
     * @param $id : id of the comment to approve
     * @return bool : false if parameter not set or error occurred, true if database updated
     */
    function ApproveComment($id){
        if (isset($id)){
            $this->id = $id;
            $this->db->set_charset("utf8");
            $stmt = $this->db->prepare("UPDATE COMMENTS
                                        SET APPROVED=?
                                        WHERE ID=?");
            $approved='Y';
            $stmt->bind_param('si',$approved,$this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result) {
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
     * @param $id : id of the comment to delete
     * @return bool : return false if parameter not set or query failed
     *                return true if comment is successfully deleted
     */
    function DeleteComment($id){
        if(isset($id)){
            $this->id = $id;
            $stmt = $this->db->prepare("DELETE FROM
                                        COMMENTS
                                        WHERE
                                        id = ?");
            $stmt->bind_param('i',$this->id);
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

}