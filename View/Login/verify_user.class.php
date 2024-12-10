<?php

/*
 * Author: Millie Jones
 * Date: 11/14/24
 * Name: verify_user.class.php
 * Description: This class extends the View class. The "display" method displays the message if log in was successful or not
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */
class VerifyUser extends View{
    //function to display log in message
    public function display(bool$condition){
        $this->header();
        if($condition == true){
            //if log in was successful
            ?>

            <div>Login</div>
            <div>
                <p>You have successfully logged in.</p>
            </div>
            <div>
            <span style="float: left">
                Log out? <a href="<?=BASE_URL?>/User/Login">Logout</a></span>
                <span style="float: right">Reset password? <a href="<?=BASE_URL?>/index.php?action=reset">Reset</a></span>
            </div>
            <?php
        }
        //if log in failed
        else{
            ?>
            <div>Login</div>
            <div>
                <p>Your last attempt to login failed. Please try again.</p>
            </div>
            <div>
            <span style="float: left">
                Already have an account? <a href="<?=BASE_URL?>/User/Login">Login</a>            </span>
                <span style="float: right">Reset password? <a href="<?=BASE_URL?>/index.php?action=reset">Reset</a></span>
            </div>
            <?php
            //display footer
            $this->footer();
        }}}
