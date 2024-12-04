<?php

/**
 * Author: Cameron Crosby
 * Date: 11/21/2024
 * File: bank_account_model.class.php
 * Description: Defines the BankAccountModel class.
 */

class BankAccountModel
{
    // Private attributes
    private Database $db;
    private mysqli $dbConnection;
    static private ?BankAccountModel $_instance = null;

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

    // public function to get model instance
    public static function getBankAccountModel(): BankAccountModel {
        // If a user model does not exist, create it
        if (self::$_instance === null)
        {
            self::$_instance = new BankAccountModel();
        }

        // Return the instance
        return self::$_instance;
    }
    // Public function to get all bank accounts, returned in an array of objects -- return false on error
    public function getBankAccounts(): array|bool {
        // Create sql statement
        $sql = "SELECT * FROM bank_account";

        // Execute query
        $query = $this->dbConnection->query($sql);

        // if query fails or returns no rows, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // put returned accounts into an associative array and return the array
        $accounts = array();
        while ($bankAccount = $query->fetch_object()) {
            // since account nickname is nullable, set it to an empty string if null
            $accountNickname = ($bankAccount->accountNickname === null) ? '' : stripslashes($bankAccount->accountNickname);

            // make a new BankAccount instance
            $account = new BankAccount($accountNickname,
                stripslashes($bankAccount->accountType),
                stripslashes($bankAccount->accountStatus),
                stripslashes($bankAccount->userId));

            // set ID
            $account->setId($bankAccount->accountId);

            // add accounts to array
            $accounts[] = $account;
        }

        return $accounts;
    }

    // Function to retrieve details of a specific bank account from an id
    public function getAccountDetails($id): BankAccount|bool {
        // Make sql statement
        $sql = "SELECT * FROM bank_account WHERE accountId = $id";

        // Execute query
        $query = $this->dbConnection->query($sql);

        // if query fails or returns no account, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // Write query result to object
        $result = $query->fetch_object();

        // since account nickname is nullable, set it to an empty string if null
        $accountNickname = ($result->accountNickname === null) ? '' : stripslashes($result->accountNickname);

        // Make BankAccount instance from $result
        $account = new BankAccount(
            $accountNickname,
            stripslashes($result->accountType),
            stripslashes($result->accountStatus),
            stripslashes($result->userId)
        );

        // Set account id
        $account->setId($result->accountId);


        return $account;

    }

    // Public function to search for a specific account
    public function searchAccounts($terms): array|bool {
        //explode multiple terms into an array
        $terms = explode(" ", $terms);

        // select statement for AND search
        $sql = "SELECT * FROM bank_account WHERE 1 ";

        foreach ($terms as $term) {
            $sql .= "AND accountNickname LIKE '%" . $term . "%'";
        }

        // execute the query
        $query = $this->dbConnection->query($sql);

        // if the search fails (or returns no rows, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // create an array
        $results = array();

        // loop through returned rows and add results to array
        while ($bankAccount = $query->fetch_object()) {
            // since account nickname is nullable, set it to an empty string if null
            $accountNickname = ($bankAccount->accountNickname === null) ? '' : stripslashes($bankAccount->accountNickname);

            // make a new BankAccount instance
            $account = new BankAccount($accountNickname,
                stripslashes($bankAccount->accountType),
                stripslashes($bankAccount->accountStatus),
                stripslashes($bankAccount->userId));

            // set ID
            $account->setId($bankAccount->accountId);


            // add accounts to array
            $results[] = $account;
        }

        return $results;

    }

}