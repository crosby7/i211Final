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
class Accounts extends View
{
    //display method
    public function display(array $accounts): void
    {
        //call the header
        $this->header();
        ?>

        <h2>All Bank Accounts</h2>
        <!-- search bar-->
        <form method="get" action="<?= BASE_URL ?>/BankAccount/search">
            <input type="text" name="query-terms" id="searchtextbox" placeholder="Search Bank Accounts" autocomplete="off" />
            <input type="submit" value="Go" />
        </form>
        <div>
            <a href='<?= BASE_URL ?>/BankAccount/create'>
                <input type="submit" class="button" value="Create an Account">
            </a>
        </div>
        <br>
        <br>

<!--        create the table-->
        <table>
            <?php
            //begin the foreach loop to iterate through all objects in the accounts array
            foreach ($accounts as $a) {
                ?>
<!--                    style for the table-->
                <style>
                    table {
                        border: solid black;
                        border-spacing: 5px
                    }

                    td {
                        border: 1px solid darkred;
                        text-align: left;
                        padding: 8px
                    }

                    th {
                        border: 1px solid darkred;
                        text-align: center;
                        padding: 8px
                    }
                </style>

<!--                create the table-->
                <tr>
                    <th>Account ID</th>
                    <th>Account Nickname</th>
                    <th>Account Type</th>
                    <th>User Id</th>
                </tr>
<!--                print accounts information in the table-->
                <td><a href="<?= BASE_URL ?>/BankAccount/details/<?= $a->getId() ?>"><?= $a->getId() ?></a></td>
                <td><?= $a->getAccountNickname() ?></td>
                <td><?= $a->getAccountType() ?></td>
                <td><?= $a->getUserId() ?></td>



                <?php

            } ?>

        </table>
        <?php
        //call the footer
        $this->footer();
    }
}
