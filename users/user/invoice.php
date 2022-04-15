<?php 
include('../../server.php');

$itemDetails = $_SESSION["order_details"];
$name = $_SESSION['user']['username'];
$address = $_SESSION['address'];
$receipt = $_GET['receipt'];
?>
<html>
<head>
    <style>
    @media (max-width:767px) {
        .hidden {
             display: none !important;
        }
    }
    </style>
</head>
<body>
    <div style="text-align:left;"><img src="../../images/capture.png">
    <b>Invoice:</b> #<?php  echo $receipt; ?></div>
    <div style="text-align:right;"><b>Sender:</b> Nekofudo</div>
    <div style="text-align: left;border-top:1px solid #000;">
        <div style="font-size: 24px;color: #666;">INVOICE</div>
    </div>
    <table style="line-height: 1.5;">
        <tr>
            <td style="text-align:right;"><b>Receiver:</b></td>
            <td style="text-align:left;"><?php echo $name; ?></td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align:left;"><?php echo $address; ?></td>
        </tr>
    </table>
    <br>
    <div style="border-bottom:1px solid #000;">
        <table style="line-height: 2;width:100%;">
            <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
                <td style="border:1px solid #cccccc;">Item Description</td>
                <td style="text-align:right;border:1px solid #cccccc;">Price (RM)</td>
                <td style="text-align:right;border:1px solid #cccccc;">Quantity</td>
                <td style="text-align:right;border:1px solid #cccccc;">Subtotal (RM)</td>
            </tr>
            <?php
            $total = 0;
            foreach ($itemDetails as $key => $value) {
                $price = $itemDetails[$key]['item_price'] * $itemDetails[$key]['item_quantity'];
                $total += $price; ?>
            <tr> 
                <td style="border:1px solid #cccccc;"><?php echo $itemDetails[$key]['item_name'] ?></td>
                <td style="text-align:right; border:1px solid #cccccc;"><?php echo number_format($itemDetails[$key]['item_price'], 2); ?></td>
                <td style="text-align:right; border:1px solid #cccccc;"><?php echo $itemDetails[$key]['item_quantity']; ?></td>
                <td style="text-align:right; border:1px solid #cccccc;"><?php echo number_format($price, 2); ?></td>
            </tr>
            <?php
            }
            ?>
            <tr style="font-weight: bold;">
                <td></td><td></td>
                <td style="text-align:right;">Total (RM)</td>
                <td style="text-align:right;"><?php echo number_format($total, 2); ?></td>
            </tr>
        </table>
    </div>
    <p><u>Kindly make your payment to</u>:<br/>
        User: Fook Wong Kok<br/>
        Bank: 渤海银行<br/>
        A/C: 05346346543634563423<br/>
        BIC: 23141434<br/>
    </p>
</body>
</html>