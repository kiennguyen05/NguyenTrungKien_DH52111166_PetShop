<?php
// The global $cart object is instantiated in the main index.php

$ac = getIndex("ac", "view"); // Default action is 'view'

if ($ac == "add") {
    $id = getIndex("id");
    $quantity = getIndex("quantity", 1);
    if ($cart->add($id, $quantity)) {
        // Optionally add a success message to the session here
    } else {
        // Optionally add an error message
    }
    // Redirect to the cart view page to prevent re-submission on refresh
    header("Location: index.php?mod=cart");
    exit();

} elseif ($ac == "delete") {
    $id = getIndex("id");
    $cart->remove($id);
    header("Location: index.php?mod=cart");
    exit();

} elseif ($ac == "update") {
    if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $id => $quantity) {
            $cart->update($id, (int)$quantity);
        }
    }
    header("Location: index.php?mod=cart");
    exit();

} else { // 'view' action
    $cart_data = $cart->getCartDetails();
    // The $cart_data variable will be available to the included detail.php file
    include "module/cart/detail.php";
}
?>