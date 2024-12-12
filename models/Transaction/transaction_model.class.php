<?php

/**
 * Author: Cameron Crosby
 * Date: 12/4/2024
 * File: transaction_model.class.php
 * Description: Defines the TransactionModel class, responsible for accessing and manipulating data related to the transaction table
 */

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
        // only admins should see all transactions. Users should only see all of THEIR transactions
        // so, we will need userId and role from $_SESSION
        try {
            if (!isset($_SESSION['role']) || !isset($_SESSION['userId']))
            {
                throw new AuthenticationException("User required to display all transactions.");
            }
            else {
                $userId = htmlspecialchars($_SESSION['userId']);
                $role = htmlspecialchars($_SESSION['role']);
            }
        }
        catch (AuthenticationException|Exception $e) {
            $view = new TransactionError();
            $view->display($e->getMessage());
            return false;
        }

        // create different sql statements for the two roles
        if ($role == "Admin") {
            // create sql
            $sql = "SELECT * FROM transaction";
        }
        else if ($role == "User") {
            // create sql
            $sql = "SELECT transactionId, transaction.accountId, type, amount, time FROM transaction JOIN bank_account ON transaction.accountId = bank_account.accountId WHERE bank_account.userId = $userId";
        }


        // try catch block to handle exceptions
        try {
            // execute the query
            $query = $this->dbConnection->query($sql);

            // if query fails or returns no rows, throw exception
            if (!$query) {
                throw new DatabaseExecutionException("Database error. Could not get transactions.");
            }
            else if ($query->num_rows == 0) {
                throw new DataMissingException("No transactions could be found.");
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
        catch (DatabaseExecutionException|DataMissingException|Exception $e) {
            $view = new TransactionError();
            $view->display($e->getMessage());
            return false;
        }
    }

    // function to get details of a specific transaction
    public function getTransactionDetails($id): Transaction|bool {
        // make sql
        $sql = "SELECT * FROM transaction WHERE transactionId = $id";

        // try catch block to handle exceptions
        try {
            // execute query
            $query = $this->dbConnection->query($sql);

            // if query fails or returns no rows, throw exceptions
            if (!$query) {
                throw new DatabaseExecutionException("Database error. Could not get transaction details.");
            }
            else if ($query->num_rows == 0) {
                throw new DataMissingException("Transaction details could not be found.");
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
        catch (DatabaseExecutionException|DataMissingException|Exception $e) {
            $view = new TransactionError();
            $view->display($e->getMessage());
            return false;
        }
    }

    // public function to add a new transaction for the selected account
    public function addTransaction($accountId, $type, $amount): bool {
        // create sql
        $sql = "INSERT INTO transaction (accountId, type, amount, time) VALUES ($accountId, $type, $amount, CURRENT_TIMESTAMP)";

        // try catch block to handle exceptions
        try {
            // execute the query
            $query = $this->dbConnection->query($sql);

            // query is a bool. if false, query failed.
            if (!$query) {
                throw new DatabaseExecutionException("Database error. Could not complete transaction.");
            }

            return $query;
        }
        catch (DatabaseExecutionException|Exception $e) {
            $view = new TransactionError();
            $view->display($e->getMessage());
            return false;
        }
    }
}