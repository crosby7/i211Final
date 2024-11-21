<?php
/**
 * Author: Alfred Acevedo-Rodriguez
 * Date: 11/21/2024
 * File: bank_account_controller_class.php
 * Description:
 */

class BankAccountController {
    private BankAccountModel $accountModel;

    public function __construct(){
        //create an object of UserModel class
        $this->accountModel = BankAccountModel::getBankAccountModel();
    }

//display index page with user accounts
    public function index(): void
    {
        // Retrieve all users from the model
        $accounts = $this->accountModel->getAccounts();

        // check if accounts are found
        if ($accounts) {
            $view = new Index();
            $view->display($accounts);
        } else {
            $message = "No users found.";
            $view = new UserError();
            $view->display($message);
        }
    }

    //display details page
    public function details(): void {
        if (!isset($_GET['id']))
        {
            // error
        }
        else {
            $id = htmlspecialchars($_GET['id']);

        }

        // Retrieve user details from the model
        $account = $this->accountModel->getAccountDetails($id);
        if ($account) {
            $view = new Details();
            $view->display($account);
        } else {
            // If no user found, show an error message
            $message = "User not found.";
            $view = new UserError();
            $view->display($message);
        }
    }
}

