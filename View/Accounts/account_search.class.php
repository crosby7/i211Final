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
class AccountSearch extends View
{
    //display method
    public function display(string $query_terms, array $accounts): void
    {
        //call the header
        $this->header();
        ?>
        <link rel="stylesheet" href="css.css">
        <h2>All Bank Accounts</h2>
        <!-- search bar-->
        <div id = "searchbar">
            <form method="get" action="<?= BASE_URL ?>/BankAccount/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search Bank Accounts" autocomplete="off" />
                <input type="submit" value="Go" />
            </form>
            <div id="suggestionDiv"></div>
        </div>
        <div>
            <a href='<?= BASE_URL ?>/BankAccount/create'>
                <input type="submit" class="button" value="Create an Account">
            </a>
        </div>
        <br>
        <br>

        <!--        create the table-->
        <table>
            <tr>
                <th>Account ID</th>
                <th>Account Nickname</th>
                <th>Account Type</th>
                <th>User Id</th>
            </tr>
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

                <!--                print accounts information in the table-->
                <tr>
                <td><a href="<?= BASE_URL ?>/BankAccount/details/<?= $a->getId() ?>"><?= $a->getId() ?></a></td>
                <td><?= $a->getAccountNickname() ?></td>
                <td><?= $a->getAccountType() ?></td>
                <td><?= $a->getUserId() ?></td>
                </tr>




                <?php


            } ?>

        </table>
        <br>
        <div>
            <a href='<?= BASE_URL ?>/BankAccount/all'>
                <input type="submit" class="button" value="Back to all Accounts">
            </a>
        </div>

        <?php
        //call the footer
        $this->footer();
    }
}

