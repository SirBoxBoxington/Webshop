<?php
/**
 * Created by PhpStorm.
 * User: Benni
 * Date: 08/06/2018
 * Time: 14:57
 */

include 'database.php';


// ---------- OPEN SESSION ----------

//Set cookie lifetime to 1 minute
session_set_cookie_params(60);
//Start session
session_start();

// ---------- SET PAGE CONTENT ----------

//Load from get
if(isset($_GET['navigate'])){
    //Set content to home
    $_SESSION['content'] = $_GET['navigate'];
    //Unset get to allow page change by changing 'content'
    unset($_GET['navigate']);
}
//Stay on page if page was not changed
else if (isset($_SESSION['content'])){
    //Noting to do
}
//Else, default to home
else {
    $_SESSION['content'] = 'home';
}

// ---------- SET LOGIN DATA ----------

//On logout, log in as guest
if(isset($_SESSION['content']) && $_SESSION['content'] == 'logout'){
    //Set user to guest
    $_SESSION['login_usr'] = 'guest';
    $_SESSION['login_pwd'] = 'guest';
    //Delete cookie
    unset($_COOKIE['login_usr']);
    unset($_COOKIE['login_pwd']);
}
//Load from form
else if (isset($_POST['login'])){
    //TODO: Check form data
    $_SESSION['login_usr'] = $_POST['login_usr'];
    $_SESSION['login_pwd'] = $_POST['login_pwd'];
}
//Else, use data already in session
else if (isset($_SESSION['login_usr']) && isset($_SESSION['login_pwd'])){
    //Noting to do
}
//Else, load from cookie
else if (isset($_COOKIE['login_usr']) && isset($_COOKIE['login_pwd'])){
    $_SESSION['login_usr'] = $_COOKIE['login_usr'];
    $_SESSION['login_pwd'] = $_COOKIE['login_pwd'];
}
//Else, use default login data (guest)
else {
    $_SESSION['login_usr'] = 'guest';
    $_SESSION['login_pwd'] = 'guest';
}

// ---------- CONNECT TO DATABASE ----------

$connection = new database();
if ($connection->connect($_SESSION['login_usr'], $_SESSION['login_pwd'])){
    //Connection successful
    $_SESSION['rank'] = $connection->getRank();
    $_SESSION['name'] = $connection->getUserName();
}
else exit("Could not connect to database.");


// ---------- REGISTER ----------

if (isset($_POST['register'])){
    //TODO: Check form data
    //Attempt to register
    if ($connection->register($_POST['register_gender'],
        $_POST['register_name'],
        $_POST['register_surname'],
        $_POST['register_address'],
        $_POST['register_postcode'],
        $_POST['register_city'],
        $_POST['register_email'],
        $_POST['register_user'],
        $_POST['register_password'])){
        //Registration successful
        //
    }
    else exit('ERROR: Registration failed');
}

// ---------- ADD PRODUCT ----------
if (isset($_POST['product_add'])){
    //TODO: Check form
    //TODO: upload image to server
    $img_link = 'some name or path';
    if ($connection->addProduct($_POST['product_add_name'],
        $_POST['product_add_desc'],
        $_POST['product_add_rating'],
        $_POST['product_add_price'],
        $img_link
    )){
        //Success
    }
    else {
        //Failure
        exit('ERROR: Could not add product');
    }
}
