<?php
    //get post value from webpage
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $valid = true;

    //validate post value
    if(empty($id)){
        echo "<h3><font color = 'red'>MenuID is empty.</font></h3>";
        $valid = false;
    }

    if(empty($qty)){
        echo "<h3><font color = 'red'>Quantity is empty.</font></h3>";
        $valid = false;
    }
    else if($qty<1 || $qty>10){
        echo "<h3><font color = 'red'>Quantity not in range(1-10).</font></h3>";
        $valid = false;
    }

    if($valid){
        //append order to list
        if(!isset($_COOKIE['orderList'])){
            $orderList = array();
        }else{
            $orderList = json_decode($_COOKIE['orderList'],true);
        }
        array_push($orderList,['id'=>$id,'qty'=>$qty]);
        setcookie("orderList",json_encode($orderList));

        echo "Your order had been placed.";
    }
?>