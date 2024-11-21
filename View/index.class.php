<?php
class Index extends View
{
    public function display()
    {
        $this->header();
           echo "<h1>Welcome to the Home Screen</h1>";
           echo '<div><input type="submit" class="button" value="all accounts"></div>';
        $this->footer();
    }
}
