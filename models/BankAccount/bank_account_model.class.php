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
    // Public function to get all users, returned in an array of objects -- return false on error
    public function getBankAccounts(): array|bool {
        // Create sql statement
        $sql = "SELECT * FROM bank_account";

        // Execute query
        $query = $this->dbConnection->query($sql);

        // if query fails or returns no rows, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // put returned users into an associative array and return the array
        $accounts = array();
        while ($bankAccount = $query->fetch_object()) {
            $account = new BankAccount(stripslashes($bankAccount->accountNickname),
                stripslashes($bankAccount->accountType),
                stripslashes($bankAccount->accountStatus),
                stripslashes($bankAccount->userId));

            // set ID
            $account->setId($bankAccount->userId);

            // add user to array
            $accounts[] = $account;
        }

        for ($i = 0; $i < count($accounts); $i++) {
            var_dump($accounts[$i]);
            echo "<br><br>";
        }

        return $accounts;
    }

    // Function to retrieve details of a specific user from an id
    public function getAccountDetails($id): User|bool {
        // Make sql statement
        $sql = "SELECT * FROM user_account WHERE userId = $id";

        // Execute query
        $query = $this->dbConnection->query($sql);

        // if query fails or returns no users, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // Write query result to object
        $result = $query->fetch_object();

        // Make User instance from $result
        $user = new User(stripslashes($result->firstName),
            stripslashes($result->lastName),
            stripslashes($result->emailAddress),
            stripslashes($result->password),
            stripslashes($result->role));

        // Set user id
        $user->setId($result->userId);

        var_dump($user);

        return $user;

    }

}

$bankModel = BankAccountModel::getBankAccountModel();

$bankModel->getBankAccounts();

$bankModel->getAccountDetails();