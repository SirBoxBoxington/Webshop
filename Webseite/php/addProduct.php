<?php
    $productReg = $priceReg = $linkReg  ="";
	$DB = new DB();
	$DB->addProduct();
?>
<div>
    <h2>Please fill in you information</h2>

    <form action="./?section=register" method="post">
        <label for="produktname">Produktname</label><br/>
        <input type="text" name="productReg" placeholder="Produktnamen eingeben" value="<?php echo $productReg; ?>"><br/>
        <label for="preis">Preis</label><br/>
        <input type="number" name="priceReg" placeholder="Preis eingeben" value="<?php echo $priceReg; ?>"><br/>
		<label for="image">Image-Link</label><br/>
        <input type="text" name="linkReg" placeholder="Link eingeben" value="<?php echo $linkReg; ?>"><br/>
        <button type="submit">Sign up</button>
    </form>
</div>