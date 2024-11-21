<?php

class Accounts extends View
{
    //display method

    public function display($accounts): void
    {
        $this->header();
        foreach ($accounts as $a) {
            ?>
            <table>
                <tr>
                    <td><a href="<?=BASE_URL?>/BankAccountController/details/<?= $a->userId ?>"></a><?= $a->id ?></td>
                    <td><?= $a->accountNickname ?></td>
                    <td><?= $a->accountType ?></td>
                    <td><?= $a->userId ?></td>
                    <td></a></td>
                </tr>
            </table>

            <?php
        }
        $this->footer();
    }
}
