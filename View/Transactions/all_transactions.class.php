<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: all_accounts.class.php
 * Description: This class extends the View class. The "display" method displays a table with all created accounts.
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

        <h2>All Transactions</h2>
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
            //begin the foreach loop to iterate through all objects in the accounts array
            foreach ($transactions as $t) {
                ?>

                <!--                print accounts information in the table-->
                <tr>
                    <td><a href="<?= BASE_URL ?>/Transaction/details/<?= $t->getId() ?>"><?= $t->getId() ?></a></td>
                    <td><?= $t->getAccountId() ?></td>
                    <td><?= $t->getType() ?></td>
                    <td><?= $t->getAmount() ?></td>
                    <td><?= $t->getTimeStamp() ?></td>
                </tr>

                <?php

            } ?>

        </table>
        <?php
        //call the footer
        $this->footer();
    }
}

