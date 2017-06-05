    <?php

    /**
     * Class Database : objet qui gere la connection a la base de donnees
     */
    class Database {

        // The database connection
        private $connection;

        function __construct()
        {

        }

        /**
         * @return bool|mysqli : false if connection failed, else return the connection
         */
        public function connect() {
            // Try and connect to the database
            $config = parse_ini_file('classes/config.ini');
            $this->connection = new mysqli('localhost',
                                           $config['username'],
                                           $config['password'],
                                           $config['dbname']);

            // If connection was not successful, handle the error
            if($this->connection === false) {
                echo 'connection to the database failed';
                return false;
            }
            return $this->connection;
        }

        /**
         * Query the database
         *
         * @param $query : The query string
         * @return mixed : The result of the mysqli::query() function
         */
        public function query($query) {
            // Connect to the database
            $connection = $this -> connect();

            // Query the database
            $result = $connection -> query($query);

            return $result;
        }

        function __destruct()
        {
    
        }
    }