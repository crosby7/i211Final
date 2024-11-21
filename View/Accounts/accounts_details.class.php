<?php
class Details extends View{
    //display methods

    public function display(BankAccount $account): void {
        $this->header();?>
            <style>
                table{
                    border: solid black;
                    border-spacing: 5px
                }
                td{
                    border: 1px solid darkred;
                    text-align: left;
                    padding: 8px
                }
                th{
                    border: 1px solid darkred;
                    text-align: center;
                    padding: 8px
                }
            </style>
        <h2>Account Details</h2>
        <table>
            <tr>
                <th>Account ID</th>
                <th>Account Nickname</th>
                <th>Account Type</th>
                <th>Account Status</th>
                <th>User ID</th>
            </tr>
        <tr>
                <td><?= $account->getId() ?></td>
                <td><?= $account->getAccountNickname() ?></td>
                <td><?= $account->getAccountType() ?></td>
                <td><?= $account->getAccountStatus() ?></td>
                <td><?= $account->getUserId() ?></td>

            </tr>
        </table>
        <?php
    $this->footer();
    } // End Display

}
