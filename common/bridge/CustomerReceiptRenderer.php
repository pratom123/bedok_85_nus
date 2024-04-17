<?php 
/**
 * Each Concrete Implementation corresponds to a specific platform and
 * implements the Implementation interface using that platform's API.
 */
require_once 'Renderer.php';

class CustomerReceiptRenderer implements Renderer
{
    public function setSubject($data): string {
        return "Successful Order No. " . $data['order_id'];
    }

    public function setMessage($data): string {
        $message = "Thank you for ordering from Bedok 85 Hawker Centre!
        <br/>
        <br/><b>Customer Name:</b> " . $data['first_name'] . ' ' . $data['last_name'] .
        "<br/><b>Order ID:</b> " . $data['order_id'] . "
        <br/><b>Order Date/Time:</b> " . $data['datetime_ordered'] . "
        <br/>
        <br/><u><b>Food Details</b></u><br/>
        " . $data['food_details'] . "
        <br/>
        <b>Cost:</b> \$" . $data['order_cost'] . "
        <br/><b>Order Status </b>";
        if ($data['collection_mode'] =='Delivery') {
            $message .= "(<b>Delivery</b> - " . $data['address'] . "):<br/>";
        } else
            $message .= "(<b>Self-pickup</b>)<b>:</b><br/>";
        $message .= $data['order_status'] . ".<br/><br/>";

        return $message;
    }
}
?>