<?php
session_start();
require_once("conn.php");
include('carttransaction.php');
$bid=$_SESSION['username'];
$sid=$_SESSION['sid'];
$isEmpty=1;
$action=$_GET["action"];
$cartTransaction=new CartTransaction($bid,$sid,$action);
if($cartTransaction->isValid()) {
switch($action) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$code=$_GET['code'];
			$stm = $conn->prepare("SELECT * FROM PRODUCTS WHERE productname=? and username=?");
			$stm->bindValue(1,$code);
			$stm->bindValue(2,$sid);
            $respo=$stm->execute();
			while ($productByCode=$respo->fetchArray()) {
			$itemArray = array($productByCode["productname"]=>array('name'=>$productByCode["productname"], 'code'=>$productByCode["productname"], 'id'=>$productByCode['id'], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"], 'image'=>$productByCode["imgsrc"]));	
			}
			
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode["productname"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode["productname"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>pySale | Store</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="cart.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
	<div class="page-header">
        <div class="top">
        <div class="nav">
                        <ul>
                            <li ><a href="home.php">Home</a></li>
                             <li ><a href="chat.php">Chat</a></li>
                        
                            </ul>
        </div>
    </div>
</div>
	<div class="content">
<div id="shopping-cart">
<div class="txt-heading">E-Shop</div>

<a id="btnEmpty" href="shop.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>

	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["id"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "KSH ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "KSH ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="shop.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>
<tr>

<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "KSH ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>
<a href="buy.php" class="purchase-btn" id="p-btn">Place Oder</a>
<div class="prducts_row">
	<div id="product-grid">
	<div class="txt-heading">Products</div>
	
<div class="products">
	<?php
	$stm = $conn->prepare("SELECT* FROM PRODUCTS where `username`=? order by id desc");
	$stm->bindValue(1,$sid);
	$products=$stm->execute();

	while ($product_array=$products->fetchArray()) {

	?>

		<div class="product-item">
			<form method="post" action="shop.php?action=add&code=<?php echo $product_array["productname"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array["imgsrc"]; ?>" style="width:100%; height: 100%;"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array["productname"]; ?></div>
			<div class="product-des"><?php echo $product_array["des"]; ?></div>

			<div class="product-price"><?php echo "$".$product_array["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	?>
	</div>
</div>	

</div>
 </div>
</BODY>
</HTML>