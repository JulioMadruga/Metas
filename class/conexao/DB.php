<?php

/**
 * Created by PhpStorm.
 * User: JULIO
 * Date: 03/09/2017
 * Time: 15:40
 */
require 'config.php';


class DB
{
    private static $instance;

    public static function getInstance(){

        if(!isset(self::$instance)){

            try{
                self::$instance = new PDO('mysql:host=localhost;dbname=garoto','root','',[PDO::MYSQL_ATTR_LOCAL_INFILE => true]);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e){

                echo $e->getMessage();

            }

        }
        return self::$instance;

    }

    public static function prepare($sql){

        return self::getInstance()->prepare($sql);

    }

}