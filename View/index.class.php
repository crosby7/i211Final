<?php
class Index extends View
{
    public function display():void
    {
        $this->header();
           echo "<h1>Welcome to the Home Screen</h1>";
           echo "<div><a href='".BASE_URL."'/BankAccountController/all/'</a>";
           echo '<input type="submit" class="button" value="all accounts"></div>';
        $this->footer();
    }
}
