<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: edit_account.class.php
 * Description: this class displays the view form for editing an account
 */

//create the class
class EditAccount extends View
{
    //define the display method
    public function display(int $id): void
    {
        //call the header
        $this->header(); ?>
<!--form-->
        <form class="new-media" action="<?= BASE_URL ?>/BankAccount/edit/<?= $id?>" method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="10">
            <p><strong>Account Nickname</strong>:
                <input name="accountNickname" type="text" size="100" value="" autofocus=""></p>
            <input type="submit" name="action" value="Edit Account" onclick = "window.location.href = "<?=BASE_URL ?>/BankAccount/all">
                <a href='<?= BASE_URL ?>/BankAccount/all/'>
                    <input id="button" type="button" class="button" value="Cancel">
                </a>
        </form>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}