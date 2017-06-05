<?php
require_once 'database.php';

class Authenticate
{
    // Declaration des variables de l'objet Authenticate
    private $id;
    private $username;
    private $password;
    private $admin;
    private $db;
    private $database;
    private $notexists;

    function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->connect();
    }

    /**
     * @param $u : username
     * @param $p : password
     */
    function login($u, $p)
    {
        $this->username = $u;
        $this->password = $p;
        // Prepare la requete MySQL
        $stmt = $this->db->prepare("SELECT password,admin FROM users WHERE username=?");
        // Donne la valeur username saisi au ?
        $stmt->bind_param('s', $this->username);
        // execute la requete
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        // teste le password fourni avec le password de la bd
        if (password_verify($this->password, $row[0])) {
            $this->admin = $row[1];
            $this->createSessionAndCookies();
        }
    }

    function logout()
    {
        $this->destroySessionAndCookies();
    }

    /**
     * @param $u
     * @param $p
     */
    function register($u, $p)
    {
        // check is a user with this username already exists
        $stmt = $this->db->prepare('SELECT username FROM users WHERE username=?');
        $stmt->bind_param('s', $u);
        // la methode execute vaut boolean - si username ne vaut rien vaut true
        $this->notexists = $stmt->execute();
        $stmt->close();
        if ($this->notexists) {
            $this->username = $u;
            // password_hash : password hidden to store it securely in the db
            $this->password = password_hash($p, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare('INSERT INTO users (username,password) VALUES(?,?)');
            $stmt->bind_param('ss', $this->username, $this->password);
            $result = $stmt->execute();
            if ($result) {
                echo 'successfully registered';
            }
        } else {
            echo 'A user with this username already exists';
            $this->destroySessionAndCookies();
        }
    }

    private function createSessionAndCookies()
    {
        @session_start();
        $_SESSION['AUTH_ID'] = $this->id;
        $_SESSION['AUTH_USERNAME'] = $this->username;
        $_SESSION['ADMIN'] = $this->admin;
        $_SESSION['ISLOGGED'] = true;
        $expire = time() + 3600 * 24 * 30;
        setcookie('AUTH_ID', $this->id, $expire);
        setcookie('AUTH_USERNAME', $this->username, $expire);
        echo 'session and cookie created';
    }

    private function destroySessionAndCookies()
    {
        unset($_SESSION['AUTH_ID']);
        unset($_SESSION['AUTH_USERNAME']);
        unset($_SESSION['ADMIN']);
        unset($_SESSION['ISLOGGED']);
        session_destroy();
        setcookie('AUTH_ID', '', time() - 3600);
        setcookie('AUTH_USERNAME', '', time() - 3600);
        echo 'session and cookie destroyed';
    }

    function __destruct()
    {

    }
}
