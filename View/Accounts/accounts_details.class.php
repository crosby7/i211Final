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
class Details extends View
{
    //define the display method
    public function display(BankAccount $account): void
    {
        //call the header
        $this->header(); ?>

        <!--        table style-->
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
        <h2>Account Details</h2>
        <!--        create the table-->
        <table>
            <tr>
                <th>Account ID</th>
                <th>Account Nickname</th>
                <th>Account Type</th>
                <th>Account Status</th>
                <th>User ID</th>
            </tr>
            <tr>
                <!--                retrieve account details and print in table-->
                <td><?= $account->getId() ?></td>
                <td><?= $account->getAccountNickname() ?></td>
                <td><?= $account->getAccountType() ?></td>
                <td><?= $account->getAccountStatus() ?></td>
                <td><?= $account->getUserId() ?></td>

            </tr>
        </table>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}
