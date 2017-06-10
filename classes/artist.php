<?php
require_once ('database.php');
/**
 * Created by PhpStorm.
 * Date: 6/3/2017
 * Time: 4:53 PM
 */
class Artist
{
    private $db;
    private $database;
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $phone_number;
    private $bio;
    private $address_id;

    function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->connect();
    }

    /**
     * @param array $params : list of parameters necessary to create a new artist
     * @return bool : return false if parameters are not set, error occurred or already exists
     *                return true if Artist has been inserted successfully
     */
    function CreateArtist(array $params){
        $this->firstname = $params['firstname'];
        $this->lastname = $params['lastname'];
        $this->email = $params['email'];
        $this->phone_number = $params['phone_number'];
        $this->bio = $params['bio'];
        $this->address_id = $params['address_id'];

        if (!empty($this->firstname) && !empty($this->lastname) && !empty($this->email)) {

            if (!$this->ArtistExists()) {
                // Create the artist
                $stmt = $this->db->prepare("INSERT INTO ARTIST
                                            (FIRSTNAME,)
                                             LASTNAME,
                                             E-MAIL,
                                             PHONE-NUMBER,
                                             BIO,
                                             ID_ADDR)
                                             VALUES
                                             (?,?,?,?,?,?)");
                $stmt->bind_param('sssssi',
                    $this->firstname,
                    $this->lastname,
                    $this->email,
                    $this->phone_number,
                    $this->bio,
                    $this->address_id);

                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if (!$result) {
                    return false;
                }
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $id : id of the artist to delete
     * @return bool : return false if parameter not set or delete failed
     *                return true id the artist has been deleted successfully
     */
    function DeleteArtist($id){
        if(isset($id)){
            $this->id = $id;
            $stmt = $this->db->prepare("DELETE FROM ARTIST
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
     * @param array $params : parameters to update the artist
     * @return bool : false if statement failed, true if finished successfully
     */
    function EditArtist(array $params){
        $this->firstname = $params['firstname'];
        $this->lastname = $params['lastname'];
        $this->email = $params['email'];
        $this->phone_number = $params['phone_number'];
        $this->bio = $params['bio'];
        $this->address_id = $params['address_id'];
        $this->id = $params['id'];

        $stmt = $this->db->prepare("UPDATE ARTIST
                                    SET FIRSTNAME=?,
                                    LASTNAME=?,
                                    E-MAIL=?,
                                    PHONE-NUMBER=?,
                                    BIO=?,
                                    ID_ADDR=?
                                    WHERE
                                    ID=?");
        $stmt->bind_param('sssssii',
            $this->firstname,
            $this->lastname,
            $this->email,
            $this->phone_number,
            $this->bio,
            $this->address_id,
            $this->id);

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if (!$result) {
            return false;
        }
        return true;
    }

    /**
     * @return bool : return true if artist exists, else return false
     */
    private function ArtistExists ()
    {
        $stmt = $this->db->prepare("SELECT 1
                                    FROM ARTIST
                                    WHERE firstname=?
                                    AND lastname=?
                                    AND e-mail=?");
        $stmt->bind_param('sss',
                        $this->firstname,
                        $this->lastname,
                        $this->email);

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if (!$result) {
            return false;
        }
        return true;
    }
}