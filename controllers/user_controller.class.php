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

    public function register(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->create();
            } else {
                // Display the registration form
                $view = new CreateUser();
                $view->display();
            }
        } catch (Exception $e) {
            $view = new UserError();
            $view->display($e->getMessage());
        }
    }

    //register user to database
    public function create(): void
    {

        // Validate POST data. If fails, throw exception
        try {
            if (!isset($_POST['firstName']) || !isset($_POST['lastName']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['role'])) {
                throw new DataMissingException("Could not create user: Required data missing (first name, last name, email, password).");
            }

            // Store registration data
            $firstName = htmlspecialchars($_POST['firstName']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $role = htmlspecialchars($_POST['role']);


            $user = $this->user_model->addUser($firstName, $lastName, $email, $password, $role);

            if (!$user) {
                throw new DatabaseExecutionException("An error occurred and user could not be added.");
            }


            $view = new Notice();
            $view->display("User successfully created!", "User");

        } catch (DataMissingException|DatabaseExecutionException|Exception $e) {
            $view = new UserError();
            $view->display($e->getMessage());
        }
    }
    public function editForm()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->edit();
            } else {
                // Display the registration form
                $view = new EditUser();
                $view->display();
            }
        } catch (DataMissingException|DatabaseExecutionException|Exception $e) {
            $view = new UserError();
            $view->display($e->getMessage());
        }
    }

    public function edit(){
        // Validate POST data. If fails, throw exception
        try {
            if (!isset($_POST['firstName']) || !isset($_POST['lastName']) || !isset($_POST['email'])) {
                throw new DataMissingException("Could not edit user: Required data missing (first name, last name, email).");
            }

            // Store registration data
            $firstName = htmlspecialchars($_POST['firstName']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $email = htmlspecialchars($_POST['email']);



            $user = $this->user_model->editAccount($firstName, $lastName, $email);

            if (!$user) {
                throw new DatabaseExecutionException("An error occurred and user could not be added.");
            }


            $view = new Notice();
            $view->display("User successfully created!", "User");

        } catch (DataMissingException|DatabaseExecutionException|Exception $e) {
            $view = new UserError();
            $view->display($e->getMessage());
        }
    }
    //display login page form
    public function login(): void
    {
        if (!isset($_SESSION['userId'])) {
            //display login form
            $view = new Login();
            $view->display();
        }
        else {
            // display verifyUser screen
            $view = new VerifyUser();
            $view->display(1);
        }
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
        try {
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
        catch (AuthenticationException|Exception $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
        }
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
        try {
            $accounts = $this->user_model->getUsers();
            if ($accounts) {
                $view = new AllUser();
                $view->display($accounts);
            }
        } catch (DatabaseExecutionException|DataMissingException|AuthenticationException|Exception $e) {
            $view = new UserError();
            $view->display($e->getMessage());
        }
      /*  // Retrieve all users from the model
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
        }*/
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