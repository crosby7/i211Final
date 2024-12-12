<?php
/**
 * Author: Alfred Acevedo-Rodriguez
 * Date: 12/5/2024
 * File: transaction_controller.class.php
 * Description:
 */


class TransactionController
{
    private TransactionModel $transaction_model;

    public function __construct()
    {
        // Create an object of TransactionModel class
        $this->transaction_model = TransactionModel::getTransactionModel();
    }

    // Display all transactions
    public function all(): void
    {
        try {
            $transactions = $this->transaction_model->getTransactions();
            if ($transactions){
                // Pass transactions to the view for display
                $view = new Transactions();
                $view->display($transactions);
            } else if ($transactions === 0){
                $message = "You do not have any transactions in your history at this time.";
                $view = new Notice();
                $view->display($message);
            }
        } catch (Exception $e){
            $view = new TransactionError();
            $view->display($e->getMessage());
        }
        /*// get all transactions from the model
        $transactions = $this->transaction_model->getTransactions();

        // Check if transactions were retrieved successfully
        if (!$transactions) {
            $message = "No transactions available or an error occurred.";
            $view = new UserError();
            $view->display($message);
            return;
        }

        // Pass transactions to the view for display
        $view = new TransactionsView();
        $view->display($transactions);*/
    }

    // Display details of a specific transaction
    public function details($id): void
    {
        // get transaction details by ID
        $transaction = $this->transaction_model->getTransactionDetails($id);

        // Check if the transaction was retrieved successfully
        if (!$transaction) {
            $message = "Transaction details could not be retrieved.";
            $view = new UserError();
            $view->display($message);
            return;
        }

        // Pass transaction details to the view
        $view = new TransactionDetails();
        $view->display($transaction);
    }

    public function createForm(): void
    {
        $transactionids = $this->transaction_model->getAccountIds();
        //display register message
        $view = new CreateTransaction();
        $view->display($transactionids);
    }

    //add account to database
    public function create(): void
    {
        // Store registration data
        $accountId = htmlspecialchars($_POST['accountId']);
        $type = htmlspecialchars($_POST['transactionType']);
        $amount = htmlspecialchars($_POST['amount']);
        $accountStatus = $this->transaction_model->addTransaction($accountId, $type, $amount);

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


    // Handle errors
    public function error($message): void
    {
        // Create an object of the UserError class
        $error = new UserError();

        // Display the error page
        $error->display($message);
    }
}
