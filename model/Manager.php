<?php
namespace blog\model;

class Manager
{
    //Fonction qui permet de ne pas répéter du code
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=db5001471156.hosting-data.io;dbname=dbs1237445;charset=utf8', 'dbu765499', '3-f*&!JaEy#BAYH');
        return $db;
    }
}