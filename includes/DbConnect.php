<?php
/**
 * Created by Kubpro.com.
 * Devloper: Rauf Abbas
 * Date: 11/4/2018
 * Time: 3:24 AM
 * Website: Kubpro.com
 */

class DbConnect{

    private $con;

    function __construct(){

    }

    function connect(){
        include_once dirname(__FILE__).'/config.php';
        $this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if(mysqli_connect_errno()){
            echo "Failed to connect with database".mysqli_connect_err();
        }

        return $this->con;
    }
}