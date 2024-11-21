<?php
/**
 * Author: Alfred Acevedo-Rodriguez
 * Date: 11/20/2024
 * File: user_controller.class.php
 * Description:Define controller class to coordinate between MVC modules.
 */
class UserController {
    private UserModel $user_model;

    public function __construct(){
        //create an object of UserModel class
        $this->user_model = UserModel::getUserModel();
    }

//display index page with user accounts
    public function index(): void
    {
        // Retrieve all users from the model
        $users = $this->user_model->getUsers();

        // If users are found, pass them to the view if not display error
        if ($users) {
            $view = new Index();
            $view->display($users);
        } else {
            $message = "No users found.";
            $view = new UserError();
            $view->display($message);
        }
    }

    //display details page
    public function details(): void {
        $id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);

            // Retrieve user details from the model
        $user = $this->user_model->getDetails($id);
            if ($user) {
                $view = new Details();  // Assuming a Details view class exists
                $view->display($user);  // Pass user data to the view for display
            } else {
                // If no user found, show an error message
                $message = "User not found.";
                $view = new UserError();
                $view->display($message);
            }
    }
}

