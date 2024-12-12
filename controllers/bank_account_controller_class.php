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
        try {
            $accounts = $this->accountModel->getBankAccounts();
            if ($accounts) {
                $view = new Accounts();
                $view->display($accounts);
            } else if ($accounts === 0){
                $message = "You do not have any bank accounts.";
                $view = new Notice();
                $view->display($message);
            }

          /*  // check if accounts are found
            if ($accounts) {
                $view = new Accounts();
                $view->display($accounts);
            } else {
                // Handle case where no accounts are found
                $message = "No accounts found.";
                $view = new AccountError();
                $view->display($message);}*/
        } catch (AuthenticationException $e){
            $view = new AccountError();
            $view->display("Authentication Error: " . $e->getMessage());
        } catch (Exception $e) {
            $view = new AccountError();
            $view->display("An error has occurred: " . $e->getMessage());
        }
        /*// Retrieve all users from the model
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
        }*/
    }

    //display details page
    public function details($id = null): void {
        try {


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
        $balance = $this->accountModel->getBalance($id);

        if ($account) {
            $view = new AccountDetails();
            $view->display($account, $balance);
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
        } catch (DatabaseExecutionException|DataMissingException $e) {
            $view = new AccountError();
            $view->display($e->getMessage());
        }catch (Exception $e) {
            // Handle any other exceptions
            $view = new AccountError();
            $view->display("An unexpected error occurred: " . $e->getMessage());
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
        $view = new CreateAccount();
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
        $view->display($message);
    }

    public function editForm(): void
    {
        //display register message
        $view = new EditAccount();
        $view->display();
    }

    public function edit($id): void
    {
        if ($id === null) {
            // error
            $message = "No account specified.";
            $view = new AccountError();
            $view->display($message);
            die();
        }

        $id = htmlspecialchars($id);
        $newNickname= isset($_POST['accountNickname']) ? trim($_POST['accountNickname']) : null;
        $editAccount = $this->accountModel->editAccount($id, $newNickname);

    }

    public function delete($id): void {
        if ($id === null) {
            // error
            $message = "No account specified.";
            $view = new AccountError();
            $view->display($message);
            die();
        }
        $id = htmlspecialchars($id);
        $deleteAccount = $this->accountModel->deleteAccount($id);
        //display  message
        $message = "This account has successfully been deleted.";
        $view = new Notice();
        $view->display($message);
    }


    public function suggest($terms): void
    {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $accounts = $this->accountModel->searchAccounts($query_terms);
        /*
         * array(1) {
              [0]=>
              object(BankAccount)#10 (5) {
                ["id":"BankAccount":private]=>
                int(3)
                ["accountNickname":"BankAccount":private]=>
                string(13) "House Account"
                ["accountType":"BankAccount":private]=>
                string(8) "Checking"
                ["accountStatus":"BankAccount":private]=>
                string(9) "Overdrawn"
                ["userId":"BankAccount":private]=>
                string(1) "3"
              }
            }
            ["House Account"]

         */
        //retrieve the related account nicknames
        $nicknames = array();
        if ($accounts) {
            foreach ($accounts as $account) {
                $nicknames[] = $account->getAccountNickname();
               //console_php($nicknames);
            }
        }
        //echo $nicknames;
        echo json_encode($nicknames);
    }

    public function notice($message): void
    {
        //create an object of the notice class
        $notice = new Notice();
        //display the notice page
        $notice->display($message);
    }


}
