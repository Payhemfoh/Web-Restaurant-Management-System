<?php
/*
    This script will initialize the database in the computer.
    This script will:
    -check if connection to mysql database is success
    -database is present in database
    -table is present in database
    -create database if not present
    -create table if not present
*/

/*
    define constant values for the variables:
    IP = localhost
    username = ""
    password = ""
    database = "RMS_Database"
    tableName : array()
*/
    const IP = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";
    const DATABASE = "RMS_Database";
    const TABLENAME = ["customer","position","staff","stock","payment","menu_category","menu","delivery","orders","order_item","ingredient"];
    const TABLEATTRIBUTE = [
        "CUSTOMERTABLE",
        "POSITIONTABLE",
        "STAFFTABLE",
        "STOCKTABLE",
        "PAYMENTTABLE",
        "CATEGORYTABLE",
        "MENUTABLE",
        "DELIVERYTABLE",
        "ORDERTABLE",
        "ORDERITEMTABLE",
        "INGREDIENTTABLE"
    ];

    $DELIVERYTABLE = [
        "delivery_id" => " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,",
        "customer_address"=>" VARCHAR(150),",
        "chatFile"=>" VARCHAR(100),",
        "staff_longitude"=>" FLOAT,",
        "staff_latitude"=>" FLOAT"
    ];

    $CUSTOMERTABLE = [
        "customer_id" => " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,",
        "username" => " VARCHAR(50) NOT NULL UNIQUE,",
        "password" => " VARCHAR(64) NOT NULL,",
        "email" => " VARCHAR(50) NOT NULL,",
        "first_name" =>" VARCHAR(50) NOT NULL,",
        "last_name" => " VARCHAR(50) NOT NULL,",
        "address" => " VARCHAR(50) NULL,",
        "gender" => " ENUM('M','F') NULL,",
        "date_of_birth" => " DATE NULL,",
        "phone_number" => " VARCHAR(11) NULL"
    ];

    $POSITIONTABLE = [
        "position_id" => " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,",
        "position_name" => " VARCHAR(50) NOT NULL,",
        "access_customer_module" =>" ENUM('T','F') NOT NULL,",
        "access_staff_module" => " ENUM('T','F') NOT NULL,",
        "access_payment_module" => " ENUM('T','F') NOT NULL,",
        "access_stock_module" => " ENUM('T','F') NOT NULL,",
        "access_menu_module" => " ENUM('T','F') NOT NULL,",
        "access_pickup_module" => " ENUM('T','F') NOT NULL,",
        "access_delivery_module" => " ENUM('T','F') NOT NULL,",
        "access_analysis_module" => " ENUM('T','F') NOT NULL,",
        "access_orderChecking_module" => " ENUM('T','F') NOT NULL"
    ];

    $STAFFTABLE =[ 
        "staff_id" => " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,",
        "position_id" => " INT NOT NULL,",
        "username" => " VARCHAR(50) NOT NULL,",
        "password" => " VARCHAR(64) NOT NULL,",
        "email" => " VARCHAR(50) NOT NULL,",
        "first_name" =>" VARCHAR(50) NOT NULL,",
        "last_name" => " VARCHAR(50) NOT NULL,",
        "address" => " VARCHAR(50) NULL,",
        "gender" => " ENUM('M','F') NULL,",
        "date_of_birth" => " DATE NULL,",
        "phone_number" => " VARCHAR(11) NULL,",
        "FOREIGN KEY"=>" (position_id) REFERENCES RMS_Database.position(position_id)"
    ];

    $MENUTABLE = [
        "menu_id" => " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,",
        "menu_name" => " VARCHAR(50) NOT NULL,",
        "category_id" => "INT NOT NULL,",
        "menu_description" => " VARCHAR(200) NOT NULL,",
        "menu_price" => " FLOAT NOT NULL,",
        "menu_picture" => " VARCHAR(50) NOT NULL,",
        "FOREIGN KEY" => " (category_id) REFERENCES RMS_Database.menu_category(category_id)"
    ];

    $ORDERTABLE = [
        "order_id" => " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,",
        "customer_id" => " INT NOT NULL,",
        "date_time" => " DATETIME NOT NULL,",
        "order_type" => "VARCHAR(20) NOT NULL,",
        "table_no"=>"INT, ",
        "overall_status" => "ENUM('order received','preparing','delivering','arrived') NOT NULL,",
        "payment_id" => "INT,",
        "delivery_id" => "INT,",
        "FOREIGN KEY" => "(customer_id) references RMS_Database.customer(customer_id),",
        "FOREIGN KEY" => "(payment_id) references RMS_Database.payment(payment_id),",
        "FOREIGN KEY" => "(delivery_id) references RMS_Database.delivery(delivery_id)"
    ];

    $PAYMENTTABLE = [
        "payment_id" => " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,",
        "staff_id" => " INT,",
        "date_time" => "DATETIME NOT NULL,",
        "total_price" => "FLOAT NOT NULL,",
        "FOREIGN KEY"=>"(staff_id) references RMS_Database.staff(staff_id)"
    ];

    $STOCKTABLE = [
        "stock_id" => " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,",
        "stock_name" => " VARCHAR(50) NOT NULL,",
        "stock_description" => " VARCHAR(200) NOT NULL,",
        "quantity" => "FLOAT NOT NULL"
    ];

    $ORDERITEMTABLE = [
        "stock_id" =>" INT NOT NULL,",
        "menu_id" =>" INT NOT NULL,",
        "order_id" => " INT NOT NULL,",
        "order_status" => "ENUM('preparing','completed') NOT NULL,",
        "quantity" =>" FLOAT NOT NULL,",
        "FOREIGN KEY" => " (menu_id) references RMS_Database.menu(menu_id),",
        "FOREIGN KEY" => " (order_id) references RMS_Database.orders(order_id)"
    ];

    $CATEGORYTABLE = [
        "category_id" => " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,",
        "category_name" => " VARCHAR(20) NOT NULL"
    ];

    $INGREDIENTTABLE =[
        "menu_id" => " INT NOT NULL, ",
        "ingredient_id" => " INT NOT NULL,",
        "FOREIGN KEY"=>" (menu_id) REFERENCES RMS_Database.menu(menu_id),",
        "FOREIGN KEY"=>" (ingredient_id) REFERENCES RMS_Database.stock(stock_id)"
    ];

    try{
        //create connection to database
        $connect = new mysqli(IP,USERNAME,PASSWORD);

        if(mysqli_connect_errno()){
            throw new Exception("Connection Error");
        }

        while(!$connect->select_db(DATABASE)){
            $query = "CREATE DATABASE ".DATABASE;
            $connect->query($query);
        }

        //check if table if present
        //create new table if not present
        foreach(TABLENAME as $key => $value){
            /*
            $checkTableQuery = "SELECT * FROM $value";
            $connect->query($checkTableQuery);

            if(($connect->affected_rows) == -1){
            */
            $query = "DROP TABLE IF EXISTS $value;";
            $connect->query($query);

            $query = "CREATE TABLE $value (";
            foreach(${TABLEATTRIBUTE[$key]} as $col => $attribute){
                $query.=$col." ".$attribute;
            }
            $query.=")";

            echo $query."<br><br>";
            if($connect->query($query)){
                echo "table $value created!<br><br>";
            }else{
                echo $connect->error."<br><br>";
            }
        }
    }
    catch(Exception $e){
        
    }
    finally{

        //close the connection to database
        if(!is_null($connect))
            $connect->close();
    }
?>