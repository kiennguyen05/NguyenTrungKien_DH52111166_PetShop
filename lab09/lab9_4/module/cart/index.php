<?php
// The global $cart object is instantiated in the main index.php
$ac = Utils::getIndex("ac", "view"); // Default action is 'view'

if ($ac == "add") {
    $id = Utils::getIndex("id");
    $quantity = Utils::getIndex("quantity", 1);
    $cart->add($id, $quantity);
    header("Location: index.php?mod=cart");
    exit();

} elseif ($ac == "delete") {
    $id = Utils::getIndex("id");
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

} elseif ($ac == "checkout") {
    // This action will just display the checkout page, which handles logic internally.
    include "module/cart/checkout.php";

} elseif ($ac == "process_checkout") {
    // 1. Verify user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?mod=cart&ac=checkout&err=login_required");
        exit();
    }
    
    // 2. Get shipping details from POST
    $shipping_info = [
        'name' => Utils::getIndex('shipping_name', '', 'POST'),
        'address' => Utils::getIndex('shipping_address', '', 'POST'),
        'phone' => Utils::getIndex('shipping_phone', '', 'POST')
    ];

    // 3. Get cart details
    $cart_data = $cart->getCartDetails();
    if (empty($cart_data['items'])) {
        header("Location: index.php?mod=cart"); // Redirect to cart if empty
        exit();
    }

    // 4. Instantiate Order class
    $order = new Order();

    // 5. Create the order
    $order_id = $order->create($_SESSION['user_id'], $shipping_info, $cart_data);

    if ($order_id) {
        // 6. Success: Clear the cart and show thank you page
        $cart->removeall(); // Assuming a method to clear the cart
        include "module/cart/thankyou.php";
    } else {
        // Handle failure
        header("Location: index.php?mod=cart&ac=checkout&err=create_failed");
        exit();
    }

} else { // 'view' action as default
    $cart_data = $cart->getCartDetails();
    // This file was created in the previous task for lab9_3, we assume it exists
    include "module/cart/detail.php";
}
?>