<?php

/* Author: Cameron Crosby
 * Date: 11/19/2024
 * Name: database.class.php
 * Description: the Database class sets the database details.
 */

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'bankingsite',
        'tblUser' => 'user_account',
        'tblBank' => 'bank_account',
        'tblTransaction' => 'transaction'
    );
    //define the database connection object
    private ?object $objDBConnection;
    static private ?object $_instance = null;

    //constructor
    private function __construct() {

        // throw an exception if connection fails
        try {
            $this->objDBConnection = @new mysqli(
                $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
            );
            // if there is a failed connection,
            if (mysqli_connect_errno() != 0) {
                // throw exception with message
                throw new DatabaseConnectionException("Connecting to database failed: " . mysqli_connect_error());
            }
        }
        // catch any relevant exceptions and display error page
        catch (DatabaseConnectionException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase(): Database|null
    {
        if (self::$_instance == NULL) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection(): mysqli
    {
        return $this->objDBConnection;
    }

    //returns the name of the table storing users
    public function getUserTable(): string
    {
        return $this->param['tblUser'];
    }

    //returns the name of the table storing bank accounts
    public function getBankTable(): string
    {
        return $this->param['tblBank'];
    }

    //returns the name of the table storing transactions
    public function getTransactionTable(): string
    {
        return $this->param['tblTransaction'];
    }
}