<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php?navigate=home">Webshop</a>
        </div>
        <ul class="nav navbar-nav" id="links" >
            <?php   //Links generated from XML file
            //Load xml file
            $nav_links = simplexml_load_file('./xml/links.xml');
            //Display links
            //Admin
            if((isset($_SESSION['rank']) && $_SESSION['rank'] == 'admin')){
                foreach ($nav_links->link as $link){
                    //Show only links that have the visible to admin property
                    if (property_exists($link, 'visible_to_admin')){
                        echo '<li><a href="index.php?navigate=' . $link->action . '">' . $link->description . '</a>';
                    }
                }
            }
            //User or guest
            else {
                foreach ($nav_links->link as $link){
                    //Show only links that have the visible to user property
                    if (property_exists($link, 'visible_to_user')){
                        echo '<li><a href="index.php?navigate=' . $link->action . '">' . $link->description . '</a>';
                    }
                }
            }

            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
            //If user is logged in
            if($_SESSION['rank']!='guest'){
                //Show first name
                echo '<li class="btn navbar-btn btn-link"><span class="glyphicon glyphicon-user"></span> '
                    . 'Hallo, ' . $_SESSION['name'] . '</li>';
                //Show logout button
                echo '<li><a href="index.php?navigate=logout">' .
                '<span class="glyphicon glyphicon-log-out"></span> ' . 'Logout' . '</a></li>';
            }
            //If user is guest
            else {
                echo '<li><a href="index.php?navigate=login">' .
                    '<span class="glyphicon glyphicon-log-in"></span> ' . 'Login' . '</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>