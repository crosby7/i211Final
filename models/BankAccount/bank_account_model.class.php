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
        // If a bankAccount model does not exist, create it
        if (self::$_instance === null)
        {
            self::$_instance = new BankAccountModel();
        }

        // Return the instance
        return self::$_instance;
    }
    // Public function to get all bank accounts, returned in an array of objects -- return false on error
    public function getBankAccounts(): array|bool|int {
        // only admins should see all accounts. Users should only see all of THEIR accounts
        // so, we will need userId and role from $_SESSION
        try {
            if (!isset($_SESSION['role']) || !isset($_SESSION['userId']))
            {
                throw new AuthenticationException("User required to display all accounts.");
            }
            else {
                $userId = htmlspecialchars($_SESSION['userId']);
                $role = htmlspecialchars($_SESSION['role']);
            }
        }
        catch (AuthenticationException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
            return false;
        }

        if ($role === "Admin") {
            // Create sql statement to see ALL accounts
            $sql = "SELECT * FROM bank_account";
        }
        else if ($role === "User") {
            // Create sql statement
            $sql = "SELECT * FROM bank_account WHERE userId = $userId";
        }

        try {
            // Execute query
            $query = $this->dbConnection->query($sql);

            // if query fails, throw exception
            if (!$query) {
                throw new DatabaseExecutionException("Database execution failed. Please try again.");
            }

//             NEW: instead, we display a notice to users and allow them to create an account if none exist.
//             if query returns no rows, throw DataMissingException
            if ($query->num_rows == 0) {
//                throw new DataMissingException("No accounts could be found.");
                return 0;
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
                    stripslashes($bankAccount->userId),
                ($bankAccount->total));

                // set ID
                $account->setId($bankAccount->accountId);

                // add accounts to array
                $accounts[] = $account;
            }

            return $accounts;
        }
        catch (DatabaseExecutionException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
            return false;
        }
    }

    // Function to retrieve details of a specific bank account from an id
    public function getAccountDetails($id): BankAccount|bool {
        // Make sql statement
        $sql = "SELECT * FROM bank_account WHERE accountId = $id";

        try {
            // Execute query
            $query = $this->dbConnection->query($sql);

            // if query fails, throw exception
            if (!$query) {
                throw new DatabaseExecutionException("Database execution failed. Please try again.");
            }

            // if query returns no rows, throw DataMissingException
            if ($query->num_rows == 0) {
                throw new DataMissingException("No accounts could be found.");
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
                stripslashes($result->userId),
                ($result->total)

            );

            // Set account id
            $account->setId($result->accountId);


            return $account;
        }
        catch (DatabaseExecutionException|DataMissingException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
            return false;
        }

    }

    // Public function to search for a specific account
    public function searchAccounts($terms): array|bool {
        //explode multiple terms into an array
        $terms = explode(" ", $terms);

        // only admins should see all accounts. Users should only see all of THEIR accounts
        // so, we will need userId and role from $_SESSION
        try {
            if (!isset($_SESSION['role']) || !isset($_SESSION['userId']))
            {
                throw new AuthenticationException("User required to display all accounts.");
            }
            else {
                $userId = htmlspecialchars($_SESSION['userId']);
                $role = htmlspecialchars($_SESSION['role']);
            }
        }
        catch (AuthenticationException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
            return false;
        }

        if ($role === "Admin") {
            // Create sql statement to see ALL accounts (search terms added after
            $sql = "SELECT * FROM bank_account WHERE 1 ";
        }
        else if ($role === "User") {
            // Create sql statement
            $sql = "SELECT * FROM bank_account WHERE userId = $userId ";
        }

        foreach ($terms as $term) {
            $sql .= "AND accountNickname LIKE '%" . $term . "%'";
        }

        try {
            // execute the query
            $query = $this->dbConnection->query($sql);

            // if query fails, throw exception
            if (!$query) {
                throw new DatabaseExecutionException("Database execution failed. Please try again.");
            }

            // if query returns no rows, throw DataMissingException
            if ($query->num_rows == 0) {
//                throw new DataMissingException("No accounts could be found.");
                return 0;
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
                    stripslashes($bankAccount->userId),
                    ($bankAccount->total));

                // set ID
                $account->setId($bankAccount->accountId);


                // add accounts to array
                $results[] = $account;
            }

            return $results;
        }
        catch (DatabaseExecutionException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
            return false;
        }

    }

    // public function to create new bank account
    public function createAccount(): bool {
        // to create an account, a user id is needed. If SESSION is not active, this method must throw an exception
        try {
            if (!isset($_SESSION['userId'])) {
                throw new AuthenticationException("User could not be verified.");
            }
            else {
                $userId = htmlspecialchars($_SESSION['userId']);
            }
        }
        catch (AuthenticationException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
            return false;
        }

        // Check if account information is added
        if (!isset($_POST['accountType'])) {
            return false;
        }

        $accountNickname = filter_var($_POST['accountNickname']);
        $accountType = htmlspecialchars($_POST['accountType']);

        // all opened accounts start in good standing
        $accountStatus = "Good Standing";

        // create sql
        $sql = "INSERT INTO bank_account (accountNickname, accountType, accountStatus, userId, total) VALUES ('$accountNickname', '$accountType', '$accountStatus', '$userId', 0)";

        try {
            // execute query
            $query = $this->dbConnection->query($sql);

            // Handle query failure
            if (!$query) {
                throw new DatabaseExecutionException("Account creation failed. Couldn't establish account with database.");
            }

            // $query is a bool
            return $query;
        }
        catch (DatabaseExecutionException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
            return false;
        }
    }

    // public method to edit an account nickname (only nickname made sense to allow edits on logically)
    public function editAccount($accountId, $accNickname): bool {
        // Create sql statement
        $sql = "UPDATE bank_account SET accountNickname = '$accNickname' WHERE accountId = $accountId";

        // catch any exceptions in db execution
        try {
            // execute the query
            $query = $this->dbConnection->query($sql);

            // query returns a bool. If false, query failed
            if (!$query) {
                throw new DatabaseExecutionException("Update failed.");
            }

            return $query;
        }
        catch (DatabaseExecutionException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
            return false;
        }
    }

    // public function to allow a user to delete an account
    public function deleteAccount($accountId): bool {
        // create sql statement
        $sql = "DELETE FROM bank_account WHERE accountId = $accountId";

        // if query fails, throw exception
        try {
            // execute the query
            $query = $this->dbConnection->query($sql);

            // query is a bool. if false, execution failed
            if (!$query) {
                throw new DatabaseExecutionException("Deleting account failed.");
            }

            return $query;
        }
        catch (DatabaseExecutionException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
            return false;
        }
    }

    // public function to get the sum of all credits and debits for a specific account (balance)
    public function getBalance($accountId): float|bool {
        // Make sql statement
        $sql = "SELECT IFNULL(SUM(amount), 0) FROM transaction WHERE accountId = $accountId";

        // execute query
        $query = $this->dbConnection->query($sql);

        // if query fails or returns no result, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // Write query result to variable
        return $query->fetch_column();

    }

}