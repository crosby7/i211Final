<?php

class Accounts extends View
{
    //display method

    public function display(array $accounts): void
    {
        $this->header();
//        var_dump($accounts);
//        die();
       ?> <table>
        <?php foreach ($accounts as $a) {
            ?>
                <tr>
                    <td><a href="<?=BASE_URL?>/BankAccount/details/<?= $a->getId() ?>"><?= $a->getId() ?></a></td>
                    <td><?= $a->getAccountNickname() ?></td>
                    <td><?= $a->getAccountType() ?></td>
                    <td><?= $a->getUserId() ?></td>
                    <td></a></td>
                </tr>


            <?php

        } ?>

        </table>
<?php
        $this->footer();
    }
}
