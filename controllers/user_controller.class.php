<?php
/**
 * Author: Alfred Acevedo-Rodriguez
 * Date: 12/5/2024
 * File: transaction_controller.class.php
 * Description:
 */



class UserController {
    private UserModel $user_model;

    public function __construct(){
        //create an object of UserModel class
        $this->user_model = UserModel::getUserModel();
    }

    //register user to database
    public function register(): void
    {
        $user = $this->user_model->addUser();

        if (!$user) {
            $message = "An error occurred and user could not be added.";
            $view = new UserError();
            $view->display($message);
            return;
        }
        //display register message
        $view = new Register();
        $view->display();
    }
    //display login page form
    public function login(): void
    {
        //display login form
        $view = new Login();
        $view->display();
    }
    //verify user credentials to properly login
    public function verify(): void
    {
        // validate POST data. If fails, throw exception
        try {
            if (!isset($_POST['emailAddress']) || !isset($_POST['password']))
            {
                throw new DataMissingException("Could not login: email or password missing.");
            }

            // store login attempt info
            $email = htmlspecialchars($_POST['emailAddress']);
            $password = htmlspecialchars($_POST['password']);

            $verify = $this->user_model->login($email, $password);

            //display successful login
            $view = new VerifyUser();
            $view->display($verify);

        }
        catch (DatabaseExecutionException|DataMissingException|AuthenticationException|Exception $e) {
            $view = new UserError();
            $view->display($e->getMessage());
        }

    }
    //logout user
    public function logout(): void
    {
        //
        $logout = $this->user_model->logout();
        if (!$logout) {
            $message = "An error has prevented you from logging out.";
            $view = new UserError();
            $view->display($message);
            return;
        }
        //display logout success
        $view = new Logout();
        $view->display();
    }
    //display the reset password form
    public function reset(): void
    {
        //check to see if user is logged in
        if (!isset($_SESSION['emailAddress'])) {
            $message = "You must be logged in to reset your password.";
            $view = new UserError();
            $view->display($message);
            return;
        }
        //display password reset form
        $view = new Reset();
        $view->display();
    }
    //actually reset the password in the database
    public function do_reset(): void
    {
        $reset = $this->user_model->reset_password();
        if (!$reset) {
            $message = "Sorry but the password reset was not successful.";
            $view = new UserError();
            $view->display($message);
            return;

        }
        //display successful password change
        $view = new ResetConfirm();
        $view->display();

    }

    // public method to display all users
    public function all(): void
    {
        // Retrieve all users from the model
        $accounts = $this->user_model->getUsers();

        // check if accounts are found
        if ($accounts) {
            $view = new AllUser();
            $view->display($accounts);
        } else if($accounts === 0){
            $message = "No accounts found.";
            $view = new UserError();
            $view->display($message);
        } else {
            $message = "An error has occurred with your request.";
            $view = new UserError();
            $view->display($message);
        }
    }

    //display details page
    public function details($id = null): void {
        if ($id === null) {
            // error
            $message = "No account specified.";
            $view = new UserError();
            $view->display($message);
            die();
        }

        $id = htmlspecialchars($id);

        // Retrieve user details from the model
        $account = $this->user_model->getDetails($id);
        if ($account) {
            $view = new UserDetails();
            $view->display($account);
        } else if($account === 0){
            $message = "No account details found.";
            $view = new UserError();
            $view->display($message);
        }else{
            // If no user found, show an error message
            $message = "An error has occurred with your request.";
            $view = new AccountError();
            $view->display($message);
        }
    }

    //create error message
    public function error($message): void
    {
        //create an object of the Error class
        $error = new UserError();
        //display the error page
        $error->display($message);
    }

}