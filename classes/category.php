<?php
require_once ('database.php');
/**
 * Created by PhpStorm.
 * Date: 6/3/2017
 * Time: 3:35 PM
 */
class Category
{
    private $id;
    private $category_title;
    private $category_type;
    private $category_description;
    private $db;
    private $database;

    function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->connect();
    }

    /**
     * @param $category_title
     * @param $category_type
     * @param $category_description
     * @return bool : false if parameters not set,
     *                category already exists or error occurred, else true
     */
    function CreateCategory($category_title, $category_type, $category_description){
        if(isset($category_title) && isset($category_type) && isset($category_description)){
            $this->category_title = $category_title;
            $this->category_type = $category_type;
            $this->category_description = $category_description;
            // check if category already exists
            $stmt = $this->db->prepare("SELECT 1 
                                        FROM CATEGORIES
                                        WHERE CAT_TITLE=?
                                        AND CAT_TYPE=?");
            $stmt->bind_param('ss',$this->category_title,$this->category_type);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if ($result){
               return false;
            }
            // category does not exist create it
            $stmt = $this->db->prepare("INSERT INTO CATEGORIES
                                        (CAT_TITLE,
                                         CAT_DESCRIPTION,
                                         CAT_TYPE)
                                         VALUES
                                         (?,?,?)");

            $stmt->bind_param('sss',
                              $this->category_title,
                              $this->category_description,
                              $this->category_type);

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
     * @param $id : id of the category to get
     * @return array|bool : return false id category is not found or parameter not set
     *                      return array of rows if category is found.
     */
    function GetCategory($id){
        if(isset($id)){
            $this->id = $id;
            $this->db->set_charset("utf8");
            $stmt = $this->db->prepare("SELECT 
                                        CAT_TITLE,
                                        CAT_DESCRIPTION,
                                        CAT_TYPE
                                        FROM
                                        CATEGORIES
                                        WHERE
                                        id = ?");
            $stmt->bind_param('i',$this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result){
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
     * @param $id : id of the category to get
     * @return array|bool : return false id category is not found or parameter not set
     *                      return array of rows if category is found.
     */
    function GetCategoryByCategoryType($category_type){
        if(isset($category_type)){
            $this->category_type = $category_type;
            $this->db->set_charset("utf8");
            $stmt = $this->db->prepare("SELECT
                                        ID,
                                        CAT_TITLE,
                                        CAT_DESCRIPTION,
                                        CAT_TYPE
                                        FROM
                                        CATEGORIES
                                        WHERE
                                        CATEGORY_TYPE = ?");
            $stmt->bind_param('s',$this->category_type);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result){
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
     * @param $category_type : type of categories to get
     * @return array|bool : return false if parameters is not set or no rows returned
     *                      return array of rows if results are found.
     */
    function GetCategories($category_type){
        if(isset($category_type)){
            $this->category_type = $category_type;
            $this->db->set_charset("utf8");
            $stmt = $this->db->prepare("SELECT
                                        ID,
                                        CAT_TITLE,
                                        CAT_DESCRIPTION,
                                        CAT_TYPE
                                        FROM
                                        CATEGORIES
                                        WHERE
                                        CAT_TYPE = ?");
            $stmt->bind_param('s',$this->category_type);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result){
                return "no_result";
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
     * @param $id : id of the category to delete
     * @return bool : return false if parameter not set or query failed
     *                return true if category is successfully deleted
     */
    function DeleteCategory($id){
        if(isset($id)){
            $this->id = $id;
            $stmt = $this->db->prepare("DELETE FROM
                                        CATEGORIES
                                        WHERE
                                        id = ?");
            $stmt->bin_param('i',$this->id);
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