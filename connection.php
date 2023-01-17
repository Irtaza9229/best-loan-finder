<?php


function get_connection()
{
    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "lenders";
    return new mysqli($hostName, $userName, $password, $dbName);
}
