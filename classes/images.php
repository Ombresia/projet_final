<?php
require_once ('database.php');
/**
 * Created by PhpStorm.
 * Date: 6/4/2017
 * Time: 10:32 AM
 */
class Images
{
    private $db;
    private $database;
    private $id;
    private $fkid;
    private $image_path;
    private $image_type;
    private $content_type;

    function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->connect();
    }

    /**
     * @param $fkid : id of the article or artwork the image is related to
     * @param $image_path : path of the image
     * @param $image_type : type of image, thumbnail or fullsize
     * @param $content_type : type of content, article ou artwork
     * @return bool : return false if parameters not set or insert failed
     *                return true if image has been successfully inserted
     */
    function AddImage($fkid, $image_path, $image_type, $content_type){
        if(isset($fkid) && isset($image_path) && isset($image_type) && isset($content_type)){
            $this->fkid = $fkid;
            $this->image_path = $image_path;
            $this->image_type = $image_type;
            $this->content_type = $content_type;

            $stmt = $this->db->prepare("INSERT INTO IMAGES
                                        (IMAGE_PATH,
                                         IMAGE_TYPE,
                                         CONTENT_TYPE,
                                         FK_ID)
                                         VALUES
                                         (?,?,?,?)");
            $stmt->bind_param('sssi',
                              $this->image_path,
                              $this->image_type,
                              $this->content_type,
                              $this->fkid);
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
     * @param $id : id of the image to delete
     * @return bool : return false if parameter not set or delete failed
     *                return true if delete was successful
     */
    function DeleteImage($id){
        if (isset($id)){
            $this->id = $id;
            $stmt = $this->db->prepare("DELETE FROM IMAGES
                                        WHERE ID = ?");
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

    /**
     * @param $id : id of the image to edit
     * @param $fkid : id of the article or artwork the image is related to
     * @param $image_path : path of the image
     * @param $image_type : type of image, thumbnail or fullsize
     * @param $content_type : type of content, article ou artwork
     * @return bool : return false if parameters not set or insert failed
     *                return true if image has been successfully inserted
     */
    function EditImage($id, $fkid, $image_path, $image_type, $content_type){
        if(isset($id) && isset($fkid) && isset($image_path) && isset($image_type) && isset($content_type)){
            $this->id = $id;
            $this->fkid = $fkid;
            $this->image_path = $image_path;
            $this->image_type = $image_type;
            $this->content_type = $content_type;

            $stmt = $this->db->prepare("UPDATE IMAGES
                                        SET IMAGE_PATH=?,
                                         IMAGE_TYPE=?,
                                         CONTENT_TYPE=?,
                                         FK_ID=?)
                                         WHERE
                                         ID = ?");

            $stmt->bind_param('sssii',
                $this->image_path,
                $this->image_type,
                $this->content_type,
                $this->fkid,
                $this->id);

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
     * @return array|bool : return false if images could not be retrieved, an array of result if found
     */
    function GetImages(){
        $query = "SELECT * FROM IMAGES";
        $result = $this->db->query($query);
        if(!$result){
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * @param $fkid : id of the artwork or article
     * @param $content_type : artwork or article
     * @return array|bool : return false if parameters not set or statement failed
     *                      return an array of result
     */
    function GetImage($fkid, $content_type){
        if (isset($fkid) && isset($content_type)){
            $this->fkid = $fkid;
            $this->content_type = $content_type;
            $stmt = $this->db->prepare("SELECT * FROM IMAGES
                                        WHERE FK_ID = ?
                                        AND CONTENT_TYPE = ?");

            $stmt->bind_param('is',
                                $this->fkid,
                                $this->content_type);

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (!$result){
                return false;
            }
            if(!$result->num_rows == 0) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            }
            return "no_result";
        }
        else
        {
            return false;
        }
    }

}