<?php
class Index extends View
{
    public function display():void
    {
        $this->header(); ?>
           <h1>Welcome to the Home Screen</h1>
           <div>
               <a href='<?= BASE_URL ?>/BankAccount/all'>
                    <input type="submit" class="button" value="all accounts">
               </a>
           </div>
        <?php $this->footer();
    }
}
