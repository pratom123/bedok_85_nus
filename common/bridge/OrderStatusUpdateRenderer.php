<?php 
require_once 'Renderer.php';
class OrderStatusUpdateRenderer implements Renderer
{
    public function setSubject($data): string {
        return 'Bedok 85: ' . $data['stall_name'] . " Order Update";
    }
    
    public function setMessage($data): string {
        $message = "Your Order No. <b>". $data['order_id'] . "</b> status has been updated to <b>" . $data['order_status'] . "</b>.
        <br/>
        <br/><b>Customer Name:</b> " . $data['first_name'] . ' ' . $data['last_name'] .
        "<br/><b>Order Date/Time:</b> " . $data['datetime_ordered'] . "
        <br/>
        <br/><u><b>Food Details</b></u><br/>
        " . $data['food_details'] . "
        <br/>
        <b>Total Cost:</b> \$" . $data['total_cost'] . "
        <br/><b>Collection Mode: ";
        if ($data['collection_mode']=='Delivery') {
            $message .= "Delivery - " . $data['address'];
        } else
            $message .= "Self-pickup";

        $message .= "</b><br/><br/>";
        $message .= "<b>Stall Comment:</b><br/>";
        $message .= ($data['stall_comment'] === NULL || $data['stall_comment'] === '') ? "NIL" : $data['stall_comment'];

        return $message;
    }
}
?>