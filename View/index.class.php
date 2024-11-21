<?php
class Index
{
    public function display()
    {
        $this->View->header();
           echo "<h1>Welcome to the Home Screen</h1>";
           echo '<div><input type="submit" class="button" value="all accounts"></div>';
        $this->View->footer();
    }
}
