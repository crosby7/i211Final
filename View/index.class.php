<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: index.class.php
 * Description: This class extends the View class. The "display" method displays the home screen with a button to go to all accounts.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */

//create the class
class Index extends View
{
    //define the display method
    public function display(): void
    {
        //call the header
        $this->header(); ?>
        <!--            page specific content and button-->

<!--        welcome message-->
        <h1 style="color: navy">Welcome to the Home Screen</h1>
        <?php
        if (!isset($_SESSION['userId'])) {

            ?>
<!--                login or create account-->
            <h2><a href='<?= BASE_URL ?>/User/login'>Click Here to Log in</a></h2>
            <h2 style="color: navy">Don't have an account?</h2>
            <h3><a href='<?= BASE_URL ?>/User/register'>Click Here to Create an Account</a></h3>

            <?php
        } else {
            ?>
            <h3>Hello, <?= htmlspecialchars($_SESSION['firstName']) ?>
                <div>
                    <a href='<?= BASE_URL ?>/BankAccount/createForm/'>
                        <input type="submit" class="button" value="Create a Bank Account">
                    </a>
                </div>
            </h3>
<!--            logout-->
            <span style="float: left">
                Log out? <a href="<?= BASE_URL ?>/User/Logout">Logout</a></span>
            <br>
            <hr>

<!--            login credentials for testing-->
            <h4>To test or grade the application: </h4>
            <p style="text-decoration: underline">Admin Login Credentials</p>
            <p>email: admin@frameworkFinancial.com</p>
            <p>password: MyPassword</p>
            <p style='text-decoration: underline'>Regular User Login Credentials</p>
            <p>email: testUser@test.com</p>
            <p>password:MyUserPassword</p>
            <?php
        }
        //call the footer
        $this->footer();
    }
}
