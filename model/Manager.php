<?php
namespace blog\model;

class Manager
{
//Fonction qui permet de ne pas répéter du code
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        return $db;
    }
}