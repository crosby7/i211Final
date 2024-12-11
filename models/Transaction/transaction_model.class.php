<?php

/**
 * Author: Cameron Crosby
 * Date: 12/4/2024
 * File: transaction_model.class.php
 * Description: Defines the TransactionModel class, responsible for accessing and manipulating data related to the transaction table
 */

require_once ('../../application/database.class.php');
require_once ('transaction.class.php');
class TransactionModel
{
    // private attributes
    private Database $db;
    private mysqli $dbConnection;
    static private ?TransactionModel $_instance = null;

    // Singleton constructor
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();

        // Escape special chars for SQL
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        // Escape special chars for SQL
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    // public function to get model instance (or create one if none exist)
    public static function getTransactionModel(): TransactionModel {
        // if a transaction model does not exist, create it
        if (self::$_instance === null) {
            self::$_instance = new TransactionModel();
        }

        // return the instance
        return self::$_instance;
    }

    // public function to get all transactions
    public function getTransactions(): array|bool {
        // create sql
        $sql = "SELECT * FROM transaction";

        // execute the query
        $query = $this->dbConnection->query($sql);

        // if query fails or returns no rows, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // put returned transactions in an array
        $transactions = array();
        while ($transact = $query->fetch_object()) {
            // make a new Transaction instance
            $result = new Transaction(stripslashes($transact->accountId),
                stripslashes($transact->type),
                stripslashes($transact->amount),
                stripslashes($transact->time));

            // set ID
            $result->setId($transact->transactionId);

            // add accounts to array
            $transactions[] = $result;
        }

        return $transactions;
    }

    // function to get details of a specific transaction
    public function getTransactionDetails($id): Transaction|bool {
        // make sql
        $sql = "SELECT * FROM transaction WHERE transactionId = $id";

        // execute query
        $query = $this->dbConnection->query($sql);

        // if query fails or returns no rows, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // write query result to object
        $result = $query->fetch_object();

        // Make Transaction instance from result
        $transaction = new Transaction(stripslashes($result->accountId),
            stripslashes($result->type),
            stripslashes($result->amount),
            stripslashes($result->time)
        );

        // set transaction id
        $transaction->setId($result->transactionId);

        return $transaction;
    }
}