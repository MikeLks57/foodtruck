<?php 
if(!isset($_SESSION['user'])) {
    exit;
}

$orders = getOrders();

echo json_encode($orders);