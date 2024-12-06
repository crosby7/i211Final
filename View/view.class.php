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
        <body>
        <h1><span style="color: darkred; font-family: serif; font-size: 36pt">Framework Financial Services</span></h1>
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
