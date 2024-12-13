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
            if ($transactions) {
                // Pass transactions to the view for display
                $view = new Transactions();
                $view->display($transactions);
            } else if ($transactions === 0) {
                $message = "You do not have any transactions in your history at this time.";
                $view = new Notice();
                $view->display(
                    msg: $message,
                    controller: 'Transaction',
                    method: 'createForm',
                    buttonText: 'Create a Transaction');
            }
        } catch (DatabaseExecutionException|DataMissingException $e) {
            $view = new TransactionError();
            $view->display($e->getMessage());
        } catch (Exception $e) {
            // Handle any other exceptions
            $view = new TransactionError();
            $view->display("An unexpected error occurred: " . $e->getMessage());
        }
    }

    // Display details of a specific transaction
    public function details($id): void
    {
        try {
            // get transaction details by ID
            $transaction = $this->transaction_model->getTransactionDetails($id);

            // Check if the transaction was retrieved successfully
            if (!$transaction) {
                $message = "Transaction details could not be retrieved.";
                $view = new TransactionError();
                $view->display($message);
                return;
            }

            // Pass transaction details to the view
            $view = new TransactionDetails();
            $view->display($transaction);
        } catch (DatabaseExecutionException|DataMissingException $e) {
            $view = new TransactionError();
            $view->display($e->getMessage());
        } catch (Exception $e) {
            // Handle any other exceptions
            $view = new TransactionError();
            $view->display("An unexpected error occurred: " . $e->getMessage());
        }
    }

    public function createForm(): void
    {
        $transactionIds = $this->transaction_model->getAccountIds();
        //display register message
        $view = new CreateTransaction();
        $view->display($transactionIds);
    }

    //add account to database
    public function create(): void
    {
        try {
            // Store registration data
            $accountId = htmlspecialchars($_POST['accountId']);
            $type = htmlspecialchars($_POST['transactionType']);
            $amount = htmlspecialchars($_POST['amount']);
            $accountStatus = $this->transaction_model->addTransaction($accountId, $type, $amount);

            if (!$accountStatus) {
                $message = "An error occurred and a transaction could not be completed.";
                $view = new AccountError();
                $view->display($message);
                return;
            }
            //display create message
            $message = "You have successfully completed a transaction.";
            $view = new Notice();
            $view->display(
                msg: $message,
                controller: 'Transaction',
                method: 'all',
                buttonText: 'Return to Transactions'
            );
        } catch (DatabaseExecutionException|DataMissingException $e) {
            $view = new TransactionError();
            $view->display($e->getMessage());
        } catch (Exception $e) {
            // Handle any other exceptions
            $view = new TransactionError();
            $view->display("An unexpected error occurred: " . $e->getMessage());
        }
    }


    // Handle errors
    public function error($message): void
    {
        // Create an object of the TransactionError class
        $error = new TransactionError();

        // Display the error page
        $error->display($message);
    }
}
