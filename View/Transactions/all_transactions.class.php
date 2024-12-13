<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: all_transactions.class.php
 * Description: This class extends the View class. The "display" method displays a table with all transactions accounts.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */


//create the class
class Transactions extends View
{
    //display method
    public function display(array $transactions): void
    {
        //call the header
        $this->header();
        ?>

<!--            page title-->
        <h2 style="color: navy">All Transactions</h2>
        <br>
        <br>

        <!--        create the table-->
        <table>
            <tr>
                <th>Account ID</th>
                <th>User ID</th>
                <th>Transaction Type</th>
                <th>Transaction Amount</th>
                <th>Time Stamp</th>
            </tr>
            <?php
            //begin the foreach loop to iterate through all objects in the transaction array
            foreach ($transactions as $t) {
                ?>

                <!--                print transaction information in the table-->
                <tr>
                    <td><a href="<?= BASE_URL ?>/Transaction/details/<?= $t->getId() ?>"><?= $t->getId() ?></a></td>
                    <td><?= $t->getAccountId() ?></td>
                    <td><?= $t->getType() ?></td>
                    <td><?= sprintf("$ %.2f",$t->getAmount()) ?></td>
                    <td><?= $t->getTimeStamp() ?></td>
                </tr>

                <?php

            } ?>

        </table>
        <div style="padding-top: 50px;"
        <a href='<?= BASE_URL ?>/Transaction/createForm'>
            <input id="createButton" type="submit" class="button" value="Create a Transaction">
        </a>
        <?php
        //call the footer
        $this->footer();
    }
}

