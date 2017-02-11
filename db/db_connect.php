<?php

class DbConnect {
    private $conn = null;

    function __construct() {
        $this->db_connect('localhost', 'root', 'root');
    }

    function build_db($conn_info) {
        if($conn_info['db_name'] == 'test_db') {
            new BuildTestDb($this);
        }
    }

    function db_connect($host, $user, $password) {
        $mysqli = new mysqli($host, $user, $password);
        if ($mysqli->connect_errno) {
            $error_message = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            throw new Exception($error_message);
        }
        say(bold(grey('CONNECT DB: ')) . $mysqli->host_info);
        $this->conn = $mysqli;
    }

    function db_query($sql) {
        $result = $this->conn->query($sql);
        $result_string = $result ? green('QUERY SUCCESS') : red('QUERY FAILURE');
        say(bold($result_string) . ': "' . $sql . '"');
        return $result;
    }

    function db_exists($db_name) {
        return in_array($db_name, $this->get_db_names());
    }

    function get_db_names() {
        $databases = mysqli_query($this->conn, 'SHOW DATABASES');
        $db_names = [];
        foreach($databases as $db)
        {
            array_push($db_names, $db['Database']);
        }
        return $db_names;
    }

}