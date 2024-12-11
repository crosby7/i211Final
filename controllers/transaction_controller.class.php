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
                $view = new TransactionsView();
                $view->display($transactions);
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
        $view = new TransactionDetailsView();
        $view->display($transaction);
    }

    // Display the balance for a specific account
    public function balance($accountId): void
    {
        // Get the balance for the specified account
        $balance = $this->transaction_model->getBalance($accountId);

        // Check if the balance was retrieved successfully
        if ($balance === false) {
            $message = "Could not retrieve account balance.";
            $view = new UserError();
            $view->display($message);
            return;
        }

        // Pass the balance to the view for display
        $view = new AccountBalanceView();
        $view->display($balance);
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
