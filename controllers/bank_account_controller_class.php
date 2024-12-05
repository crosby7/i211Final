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

    public function search(): void
    {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all accounts
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching accounts
        $accounts = $this->accountModel->searchAccounts($query_terms);

        if ($accounts === false) {
            // error
            $message = "Search invalid.";
            $view = new AccountError();
            $view->display($message);
            die();
        }
        //display matched accounts
        $search = new AccountSearch();
        $search->display($query_terms, $accounts);
    }

    public function createForm(): void
    {
        //display register message
        $view = new Create();
        $view->display();
    }

    //add account to database
    public function create(): void
    {
        $accountStatus = $this->accountModel->createAccount();

        if (!$accountStatus) {
            $message = "An error occurred and an account could not be created.";
            $view = new AccountError();
            $view->display($message);
            return;
        }
        //display create message
        $message = "An account has successfully been created.";
        $view = new Notice();
        $view->display($message, "BankAccount");
    }



    public function suggest($terms): void
    {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $accounts = $this->accountModel->searchAccounts($query_terms);

        //retrieve the related account nicknames
        $nicknames = array();
        if ($accounts) {
            foreach ($accounts as $account) {
                $nicknames[] = $account->getAccountNickname();
            }
        }

        echo json_encode($nicknames);
    }

    public function notice($message): void
    {
        //create an object of the notice class
        $notice = new Notice();
        //display the notice page
        $notice->display($message, "BankAccount");
    }
}
