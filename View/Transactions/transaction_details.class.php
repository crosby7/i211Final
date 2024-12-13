<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: transaction_details.class.php
 * Description: This class extends the View class. The "display" method displays a table with the details of a particular transaction.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */

//create the class
class TransactionDetails extends View
{
    //define the display method
    public function display(Transaction $transaction): void
    {
        //call the header
        $this->header(); ?>

        <h2 style="color: navy">Transaction Details</h2>
        <!--        create the table-->
        <table>
            <tr>
                <th>Account ID</th>
                <th>Transaction Type</th>
                <th>Transaction Amount</th>
                <th>Time Stamp </th>
            </tr>
            <tr>
                <!--                retrieve transaction details and print in table-->
                <td><?= $transaction->getAccountId() ?></td>
                <td><?= $transaction->getType() ?></td>
                <td><?= $transaction->getAmount() ?></td>
                <td><?= $transaction->getTimestamp() ?></td>
            </tr>
        </table>
<!--        buttons-->
        <div style="padding-top: 50px;">
            <a href='<?= BASE_URL ?>/Transaction/all'>
                <input type="submit" class="button" value="Back to all Transactions">
            </a>
        <br><br>
            <a href='<?= BASE_URL ?>/Transaction/delete/<?= $transaction->getAccountId() ?>'>
                <input type="submit" class="button" value="Delete Account">
            </a>
        </div>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}

