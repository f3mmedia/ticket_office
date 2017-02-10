<?php

class BuildTestDb {
    private $conn = null;

    function __construct() {
        $this->conn = new DbConnect();
        $this->conn->db_query('DROP DATABASE IF EXISTS test_db');
        $this->build();
    }

    function build() {
        $this->conn->db_query('CREATE DATABASE test_db');
    }

}