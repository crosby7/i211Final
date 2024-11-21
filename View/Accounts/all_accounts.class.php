<?php

class Accounts extends View
{
    //display method

    public function display(array $accounts): void
    {
        $this->header();
//        var_dump($accounts);
//        die();
       ?>
        <h2>All Bank Accounts</h2>
        <table>
        <?php foreach ($accounts as $a) {
            ?>
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
                <tr>
                    <th>Account ID</th>
                    <th>Account Nickname</th>
                    <th>Account Type</th>
                    <th>User Id</th>
                </tr>
                    <td><a href="<?=BASE_URL?>/BankAccount/details/<?= $a->getId() ?>"><?= $a->getId() ?></a></td>
                    <td><?= $a->getAccountNickname() ?></td>
                    <td><?= $a->getAccountType() ?></td>
                    <td><?= $a->getUserId() ?></td>
                </tr>


            <?php

        } ?>

        </table>
<?php
        $this->footer();
    }
}
