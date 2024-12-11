<?php
/*
 * Author: Millie JOnes
 * Date: 11/21/2024
 * Name: view.class.php
 * Description: define the parent class for all view classes. The two methods create page header and footer.
 */

class View {

    //create the page header
    public static function header(): void {
        ?>
        <!DOCTYPE html lang="en">
        <html>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css.css">
        <head>
            <meta charset="UTF-8">
            <title>Framework Financial Services</title>
            <link href="www/css/styles.css" rel="stylesheet" type="text/css"/>
            <script>
                //create the JavaScript variable for the base url
                var BASE_URL = "<?= BASE_URL ?>";
            </script>
        </head>
        <div id="header">
          <div id="Rlogo"><img src="<?= BASE_URL ?>/logo.jpg" width = 70 height = 85 alt="logo image"></div>
            <div id="Llogo"><img src="<?= BASE_URL ?>/logo.jpg" width = 70 height = 85 alt="logo image"></div>
        <h1 style="color: green; font-family: 'Monaco'; font-size: 36pt; text-align: center">Framework Financial Services</h1>

        <div class="topnav">
            <a href='<?= BASE_URL ?>/index.php'>Home</a>
            <a href='<?= BASE_URL ?>/BankAccount/all'>Accounts</a>
            <a href='<?= BASE_URL ?>/Users/all'>Users</a>
            <a href='<?= BASE_URL ?>/Transactions/all'>Transactions</a>
            <a href='<?= BASE_URL ?>/Users/login'>Login</a>
        </div>
        </div>

        <div id="wrapper">
        <?php
    }

    //create the page footer
    public static function footer(): void {
        ?>
        </div>
        <script type="text/javascript" src="<?= BASE_URL ?>/application/ajax_autosuggestion.js"></script>
        </body>
        </html>
        <?php
    }

}
