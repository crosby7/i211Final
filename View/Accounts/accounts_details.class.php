<?php
class Details extends View{
    //display methods

    public function display(): void {
        $this->header();?>
        <table>
            <tr>
                <td><?= $account->id ?></td>
                <td><?= $account->accountNickname ?></td>
                <td><?= $account->accountType ?></td>
                <td><?= $account->accountStatus ?></td>
                <td><?= $account->userId ?></td>

            </tr>



        <?
        $this->footer();
        }
    }
