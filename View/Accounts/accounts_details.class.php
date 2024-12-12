<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: accounts_details.class.php
 * Description: This class extends the View class. The "display" method displays a table with the details of a particular account.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */

//create the class
class AccountDetails extends View
{
    //define the display method
    public function display(BankAccount $account, String $balance): void
    {
        //call the header
        $this->header(); ?>

        <h2>Account Details</h2>
        <!--        create the table-->
        <table>
            <tr>
                <th>Account ID</th>
                <th>Account Nickname</th>
                <th>Account Type</th>
                <th>Account Balance</th>
                <th>Account Status</th>
                <th>User ID</th>

            </tr>
            <tr>
                <!--                retrieve account details and print in table-->
                <td><?= $account->getId() ?></td>
                <td><?= $account->getAccountNickname() ?></td>
                <td><?= $account->getAccountType() ?></td>
                <td>$<?=$balance?></td>
                <td><?= $account->getAccountStatus() ?></td>
                <td><?= $account->getUserId() ?></td>

            </tr>
        </table>
        <div>
            <a href='<?= BASE_URL ?>/BankAccount/all'>
                <input type="submit" class="button" value="Back to all Accounts">
            </a>
        </div>

        <div>
            <a href='<?= BASE_URL ?>/BankAccount/deleteForm/<?= $account->getUserId() ?>'>
                <input type="submit" class="button" value="Delete Account">
            </a>
        </div>
        <div id="buttonDiv1">
            <a href='<?= BASE_URL ?>/BankAccount/editForm/<?=$account->getId()?>'>
                <input id="createButton" type="submit" class="button" value="Edit an Account">
            </a>
        </div>

        <?php
        //call the footer
        $this->footer();
    } // End Display

}
