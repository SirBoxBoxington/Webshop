<?php
/**
 * Created by PhpStorm.
 * User: Benni
 * Date: 09/06/2018
 * Time: 11:11
 */

class database {
    private $DB_rank = 'guest';
    private $DB_username = 'Benni';

    public function getRank(){
        //TODO
        return $this->DB_rank;
    }
    public function getUserName(){
        //TODO
        return $this->DB_username;
    }
    public function connect($username, $password){
        //TODO: actual connection

        //Success
        return true;
    }
    public function register($honorific, $name, $surname, $address, $postcode, $city, $email, $username, $password){
        //TODO: Check if username is already taken

        //TODO: attempt to add user with data

        //On success
        return true;
    }
    public function addProduct($name, $desc, $rating, $price, $img_link){
        //TODO
        return true;    //Success
    }
}
