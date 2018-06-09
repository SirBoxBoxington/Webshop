<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="btn navbar-brand btn-link">Webshop</button>
        </div>
        <ul class="nav navbar-nav">
            <?php   //Links generated from XML file
            //Load xml file
            $nav_links = simplexml_load_file('./xml/' . $_SESSION['rank'].  '.xml');
            //Display links
            foreach ($nav_links->link as $link){
                echo '<li><button type="submit" value="' . $link->action
                    . '" class="btn navbar-btn btn-link"> ' . $link->description
                    . '</button></li>';
            }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
            //If user is logged in
            if($_SESSION['rank'] != 'guest'){
                //Show first name
                echo '<li><button class="btn navbar-btn btn-link"><span class="glyphicon glyphicon-user"></span> '
                . 'Hallo, ' . $_SESSION['name'] . '</button></li>';
                //Show logout button
                echo '<li><button type="submit" value="nav_logout" class="btn navbar-btn btn-link"><span class="glyphicon glyphicon-log-out"></span> '
                . 'Logout' . '</button></li>';
            }
            //If user is guest
            else {
                echo '<li><button type="submit" value="nav_home" class="btn navbar-btn btn-link"><span class="glyphicon glyphicon-log-in"></span> '
                    . 'Login' . '</button></li>';
            }
            ?>
        </ul>
    </div>
</nav>