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

        <h2 style="color: dodgerblue">All Bank Accounts</h2>
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/BankAccount/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search Bank Accounts"
                       autocomplete="off" onkeyup="handleKeyUp(event)"/>
                <input type="submit" value="Search"/>
            </form>
            <div id="suggestionDiv"></div>
        </div>
        <div id="buttonDiv">
            <a href='<?= BASE_URL ?>/BankAccount/createForm'>
                <input id="createButton" type="submit" class="button" value="Create an Account">
            </a>
        </div>
            <a href='<?= BASE_URL ?>/Transaction/createForm'>
                <input id="createButton" type="submit" class="button" value="Create a Transaction">
            </a>
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
        <?php
        //call the footer
        $this->footer();
    }
}
