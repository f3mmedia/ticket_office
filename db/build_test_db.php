<?php

class BuildTestDb {
    private $conn = null;
    private $build_queries = [];

    function __construct() {
        $this->conn = new DbConnect();
        $this->conn->db_query('DROP DATABASE IF EXISTS test_db;');
        $this->build();
    }

    function add_query($query) {
        array_push($this->build_queries, $query);
    }

    function build() {
        $this->add_query('CREATE DATABASE test_db;');
        $this->add_query('USE test_db;');
        $this->add_user_table();
        $this->execute_build();
    }

    function execute_build() {
        say(bold(blue('EXECUTING BUILD SCRIPT FOR TEST DB:')));
        $all_queries_successful = true;
        $GLOBALS['indent']++;
        foreach($this->build_queries as $query) {
            $query_result = $this->conn->db_query($query);
            if(!$query_result) {
                $all_queries_successful = false;
            }
        }
        $GLOBALS['indent']--;
        say(bold(blue('SCRIPT FINISHED, PASS RESULT: ')) . strtoupper(str_bool($all_queries_successful)));
    }

    function add_user_table() {
        $user_columns = [
            'forename VARCHAR(20)',
            'surname VARCHAR(20)',
            'email VARCHAR(50)',
            'username VARCHAR(40)',
            'password VARCHAR(20)'
        ];
        $query = 'CREATE TABLE user (' . join(', ', $user_columns) . ');';
        $this->add_query($query);
    }

}