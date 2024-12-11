<?php
/**
 * Author: Cameron Crosby
 * Date: 11/20/2024
 * File: user_model.class.php
 * Description: Defines the UserModel class responsible for manipulating data for users
 */

class UserModel
{

    // Private attributes
    private Database $db;
    private mysqli $dbConnection;
    static private ?UserModel $_instance = null;

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

    // Public function to get model instance
    public static function getUserModel(): UserModel {
        // If a user model does not exist, create it
        if (self::$_instance === null)
        {
            self::$_instance = new UserModel();
        }

        // Return the instance
        return self::$_instance;
    }

    // Public function to get all users, returned in an array of objects -- return false on error
    public function getUsers(): array|bool {
        // Create sql statement
        $sql = "SELECT * FROM user_account";

        // Execute query
        $query = $this->dbConnection->query($sql);

        // if query fails or returns no rows, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // put returned users into an associative array and return the array
        $users = array();
        while ($user = $query->fetch_object()) {
            $account = new User(stripslashes($user->firstName),
                        stripslashes($user->lastName),
                        stripslashes($user->emailAddress),
                        stripslashes($user->password),
                        stripslashes($user->role));

            // set ID
            $account->setId($user->userId);

            // add user to array
            $users[] = $account;
        }

        return $users;
    }

    // Function to retrieve details of a specific user from an id
    public function getDetails($id): User|bool {
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

        return $user;

    }

    public function addUser(): bool {
        if (!isset($_POST['emailAddress'])) {
            return false;
        }

        // Get user registration info from post
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $email = htmlspecialchars($_POST['emailAddress']);
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

        // Create sql statement
        $sql = "INSERT INTO user_account (firstName, lastName, emailAddress, password, role)";
        $sql .= "VALUES ('$firstName', ''$lastName', '$email', '$password', 'User')";

        // Execute sql
        $query = $this->dbConnection->query($sql);

        // if query fails, return false
        if (!$query) {
            return false;
        }

        // User has been added. Return true to controller
        return true;
    }

    // public function to verify a user (login)
    public function login($email, $password): bool {
        // First, ensure POST is set with email and password -- otherwise return false
        if (!isset($_POST['emailAddress']) || !isset($_POST['password']))
        {
            return false;
        }

        // store login attempt info
        $email = htmlspecialchars($_POST['emailAddress']);
        $password = htmlspecialchars($_POST['password']);

        // create sql
        $sql = "SELECT * FROM user_account WHERE emailAddress = '$email'";

        // Execute query
        $query = $this->dbConnection->query($sql);

        // If query fails, return false
        if (!$query || $query->num_rows == 0) {
            return false;
        }

        // store result in a row
        $row = $query->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password']))
        {
            // start session if not started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Store user info in SESSION vars
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['emailAddress'] = $row['emailAddress'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['userId'] = $row['userId'];
            return true;
        }
        else {
            return false;
        }
    }

    // public function to log a user out (remove session vars)
    public function logout(): bool {
        // Destroy session vars and return true to controller
        $_SESSION = array();
        setcookie(session_id(), "", time() - 3600);
        session_destroy();
        session_write_close();

        // if the user is successfully logged out, return true
        if (!isset($_SESSION['firstName'])) {
            return true;
        }
        else {
            // failed to sign out
            return false;
        }
    }

    // Public function to allow a user to reset their password
    public function reset_password(): bool {
        // Retrieve email and new password
        if (!isset($_POST['emailAddress']) || !isset($_POST['password']))
        {
            // Email or password is not set -- return false
            return false;
        }

        $email = htmlspecialchars($_POST['emailAddress']);
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

        // SQL to update password for that user
        $sql = "UPDATE user_account SET password = '$password' WHERE emailAddress = '$email'";

        // Execute the query
        $query = $this->dbConnection->query($sql);

        // query will return a bool
        return $query;
    }

}