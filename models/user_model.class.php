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
    }
}