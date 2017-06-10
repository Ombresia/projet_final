<?php
require_once ('database.php');
/**
 * Created by PhpStorm.
 * Date: 6/3/2017
 * Time: 5:02 PM
 */
class Address
{
    private $db;
    private $database;
    private $id;
    private $address1;
    private $address2;
    private $region;
    private $zipcode;
    private $country;
    private $latitude;
    private $longitude;


    function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->connect();
    }

    function CreateAddress(array $params){
        $this->address1 = $params['address1'];
        $this->address2 = $params['address2'];
        $this->region = $params['region'];
        $this->zipcode = $params['zipcode'];
        $this->country = $params['country'];
        $this->latitude = $params['latitude'];
        $this->longitude = $params['longitude'];

        if (!empty($this->address1) && !empty($this->region) && !empty($this->zipcode) && !empty($this->country)){
            $stmt = $this->db->prepare("INSERT INTO
                                        ADDRESSES
                                        (ADDRESS1,
                                         ADDRESS2,
                                         REGION,
                                         ZIPCODE,
                                         COUNTRY,
                                         LATITUDE,
                                         LONGITUDE)
                                         VALUES
                                         (?,?,?,?,?,?,?)");

            $stmt->bind_param('sssssdd',
                              $this->address1,
                              $this->address2,
                              $this->region,
                              $this->zipcode,
                              $this->country,
                              $this->latitude,
                              $this->longitude);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result){
                $stmt->close();
                return false;
            }
            $stmt->close();
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @return array|bool : return false when no result,
     *                      array of results when found.
     */
    function GetAddresses(){
        $query = "SELECT * FROM ADDRESSES";
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
     * @param $id : id of the address to get
     * @return array|bool : return false if address not found or id not set
     *                      return array of results when found
     */
    function GetAddress($id){
        if(isset($id)){
            $this->id = $id;
            $this->db->set_charset("utf8");
            $stmt = $this->db->prepare("SELECT *
                                        FROM ADDRESSES
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

    function DeleteAddress($id) {
        $this->id = $id;
        $stmt = $this->db->prepare("DELETE 
                                    FROM ADDRESSES
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
}