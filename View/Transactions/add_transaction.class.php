<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: create_account.class.php
 * Description:
 */

//create the class
class CreateTransaction extends View
{
    //define the display method
    public function display(Array $accountIds): void
    {
        //call the header
        $this->header(); ?>

        <form class="new-media" action="<?= BASE_URL ?>/Transaction/create" method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="10">
            <p><strong>Account ID</strong>:
                <select name="transactionType" id="accountType">j
                    <?php
                    foreach($accountIds as $id){
                    ?>
                    <option value="<?=$id?>">Account #<?=$id?></option>
                        <?php }?>
                </select>
            <p><strong>Transaction Type</strong>:
                <select name="transactionType" id="accountType">
                    <option value="Deposit">I want to make a deposit</option>
                    <option value="Withdrawal">I want to make a withdrawal</option>
                </select>
            <p><strong>Transaction Amount</strong>:
                <input name="transaction" type="text" size="350" value="" autofocus=""></p>
                <input type="submit" name="action" value="Create Account">
                <a href='<?= BASE_URL ?>/BankAccount/all'>
                    <input type="button" class="button" value="Cancel">
                </a>
        </form>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}

