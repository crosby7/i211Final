<?php
class Details extends View{
    //display methods

    public function display(BankAccount $account): void {
        $this->header();?>
        <table>
            <tr>
                <td><?= $account->getId() ?></td>
                <td><?= $account->getAccountNickname() ?></td>
                <td><?= $account->getAccountType() ?></td>
                <td><?= $account->getAccountStatus() ?></td>
                <td><?= $account->getUserId() ?></td>

            </tr>
        <?php
    $this->footer();
    } // End Display

}
