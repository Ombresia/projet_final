<?php
require_once('database.php');

/**
 * Created by PhpStorm.
 * Date: 6/3/2017
 * Time: 8:16 PM
 */
class Artwork
{
    private $db;
    private $database;
    private $artwork_title;
    private $artwork_description;
    private $width;
    private $height;
    private $price;
    private $id;
    private $date_created;
    private $date_published;
    private $id_artist;
    private $id_cat;
    private $category_id;

    function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->connect();
    }

    /**
     * @param array $params : parameters to create the artwork
     * @return bool : return false if artwork already exists or statement failed
     *                return true if artwork has been inserted successfully
     */
    function CreateArtwork(array $params)
    {
        $this->artwork_title = $params['artwork_title'];
        $this->artwork_description = $params['artwork_description'];
        $this->width = $params['width'];
        $this->height = $params['height'];
        $this->price = $params['price'];
        $this->date_created = $params['date_created'];
        $this->date_published = $params['date_published'];
        $this->id_artist = $params['id_artist'];
        $this->id_cat = $params['id_cat'];

        if (!empty($this->artwork_title) && !empty($this->artwork_description) && !empty($this->id_cat) && !empty($this->id_artist)) {
            // Check if Artwork already exists
            if (!$this->ArtworkExists()) {
                $stmt = $this->db->prepare("INSERT INTO ARTWORK
                                            (ART_TITLE,
                                             ART_DESCRIPTION,
                                             WIDTH,
                                             HEIGHT,
                                             PRICE,
                                             DATE_PUBLISHED,
                                             DATE_CREATED,
                                             ID_ARTIST,
                                             ID_CAT)
                                             VALUES
                                             (?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param('ssdddssii',
                    $this->artwork_title,
                    $this->artwork_description,
                    $this->width,
                    $this->height,
                    $this->price,
                    $this->date_published,
                    $this->date_created,
                    $this->id_artist,
                    $this->id_cat);

                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if (!$result) {
                    return false;
                }
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $id : id of the artwork to delete
     * @return bool : return false if statement failed or parameter id not set
     *                return true if artwork has been deleted successfully
     */
    function DeleteArtwork($id)
    {
        if (isset($id)) {
            $this->id = $id;
            $stmt = $this->db->prepare("DELETE FROM ARTWORK
                                        WHERE ID = ?");
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (!$result) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param array $params : values to edit the artwork
     * @return bool
     */
    function EditArtwork(array $params)
    {
        $this->artwork_title = $params['artwork_title'];
        $this->artwork_description = $params['artwork_description'];
        $this->width = $params['width'];
        $this->height = $params['height'];
        $this->price = $params['price'];
        $this->date_created = $params['date_created'];
        $this->date_published = $params['date_published'];
        $this->id_artist = $params['id_artist'];
        $this->id_cat = $params['id_cat'];

        if (!empty($this->artwork_title) && !empty($this->artwork_description) && !empty($this->id_cat) && !empty($this->id_artist)) {
            $stmt = $this->db->prepare("UPDATE ARTWORK
                                            SET ART_TITLE=?,
                                             ART_DESCRIPTION=?,
                                             WIDTH=?,
                                             HEIGHT=?,
                                             PRICE=?,
                                             DATE_PUBLISHED=?,
                                             DATE_CREATED=?,
                                             ID_ARTIST=?,
                                             ID_CAT=?)
                                             WHERE
                                             ID = ?");
            $stmt->bind_param('ssdddssiii',
                $this->artwork_title,
                $this->artwork_description,
                $this->width,
                $this->height,
                $this->price,
                $this->date_published,
                $this->date_created,
                $this->id_artist,
                $this->id_cat,
                $this->id);

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (!$result) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array|bool : return false if no result, else return array of results
     */
    function GetArtworks()
    {
        $this->db->set_charset("utf8");
        $query = "SELECT ART.*,
                        CAT.CAT_TITLE,
                        CAT.CAT_DESCRIPTION,
                        ARTIST.FIRSTNAME,
                        ARTIST.LASTNAME                          
                    FROM ARTWORK ART, 
                                     CATEGORIES CAT,
                                     ARTIST
                    WHERE CAT.ID = ART.ID_CAT
                    AND ART.ID_ARTIST = ARTIST.ID";
        $result = $this->db->query($query);
        if (!$result) {
            return false;
        }
        if (!$result->num_rows == 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        return "no_result";
    }

    /**
     * @param $id : id of the artwork to retrieve
     * @return array|bool : return false if artwork was not found, else return an array of results
     */
    function GetArtwork($id)
    {
        if (isset($id)) {
            $this->id = $id;

            $this->db->set_charset("utf8");
            $stmt = $this->db->prepare("SELECT * 
                                    FROM ARTWORK ART 
                                    AND ART.ID = ?");
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (!$result) {
                return false;
            }
            if (!$result->num_rows == 0) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            }
            return "no_result";
        }
        return false;
    }


    /**
     * @param $id : id of the artwork to retrieve
     * @return array|bool : return false if artwork was not found, else return an array of results
     */
    function GetArtworkByCategoryId($id)
    {
        if (isset($id)) {
            $this->category_id = $id;

            $this->db->set_charset("utf8");
            $stmt = $this->db->prepare("SELECT ART.*, IMG.*
                                    FROM ARTWORK ART,
                                    CATEGORIES CAT,
                                    IMAGES IMG
                                    WHERE CAT.ID = ART.ID_CAT
                                    AND IMG.FK_ID = ART.ID
                                    AND IMG.IMAGE_TYPE = 'thumbs'
                                    AND ART.ID_CAT = ?");
            $stmt->bind_param('s', $this->category_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (!$result) {
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
        return false;
    }

    /**
     * @return bool : return true if artwork exists, else return false
     */
    private function ArtworkExists()
    {
        $this->db->set_charset("utf8");
        $stmt = $this->db->prepare("SELECT 1 
                                    FROM ARTWORK 
                                    WHERE ART_TITLE = ?");
        $stmt->bind_param('s', $this->artwork_title);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if (!$result) {
            return false;
        }
        return true;
    }

}