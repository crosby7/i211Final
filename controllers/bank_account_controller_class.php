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

    public function index(): void
    {
        $view = new Index();
        $view->display();
    }

//display index page with user accounts
    public function all(): void
    {
        // Retrieve all users from the model
        $accounts = $this->accountModel->getBankAccounts();

        // check if accounts are found
        if ($accounts) {
            $view = new Accounts();
            $view->display($accounts);
        } else if($accounts === 0){
            $message = "No accounts found.";
            $view = new AccountError();
            $view->display($message);
        } else {
            $message = "An error has occurred with your request.";
            $view = new AccountError();
            $view->display($message);
        }
    }

    //display details page
    public function details($id = null): void {
        if ($id === null) {
            // error
            $message = "No account specified.";
            $view = new AccountError();
            $view->display($message);
            die();
        }

        $id = htmlspecialchars($id);

        // Retrieve user details from the model
        $account = $this->accountModel->getAccountDetails($id);
        if ($account) {
            $view = new Details();
            $view->display($account);
        } else if($account === 0){
            $message = "No account details found.";
            $view = new AccountError();
            $view->display($message);
        }else{
            // If no user found, show an error message
            $message = "An error has occurred with your request.";
            $view = new AccountError();
            $view->display($message);
        }
    }
}

