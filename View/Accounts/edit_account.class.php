<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: create_account.class.php
 * Description:
 */

//create the class
class EditAccount extends View
{
    //define the display method
    public function display(int $id): void
    {
        //call the header
        $this->header(); ?>

        <form class="new-media" action="<?= BASE_URL ?>/BankAccount/edit/<?= $id?>" method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="10">
            <p><strong>Account Nickname</strong>:
                <input name="accountNickname" type="text" size="350" value="" autofocus=""></p>
            <p><strong>Account ID</strong>: <br>
                <input name="accountID" type="hidden" size="350" required=""></p>
            <input type="submit" name="action" value="Edit Account" onclick = "window.location.href = "<?=BASE_URL ?>/BankAccount/all">
            <input type="button" value="Cancel" onclick="window.location.href = "<?= BASE_URL ?>/BankAccount/all">
        </form>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}