<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="includes/style.css">
<link rel="stylesheet" href="css/style.css">
<body>
    <style>

    </style>

<button onclick="document.getElementById('id01').style.display='block'" class="w3-button logistixOrangeBack"  <b>Add Product</b></button>
<div class="w3-container ">
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container w3-light-grey">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
<div class="row justify-content-center">
    <div class="logistixOrange">
     <h1>Add Products</h1>
    </div>
    <form method="POST" action="process.php" enctype="multipart/form-data">
           
            <div class="logistix-container">   
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                
                    <label for ="name"> <b>Name</label></b>
                <input class="w3-input" type="text" placeholder="Product Name" 
                       value="<?php echo $name; ?>"  name="name"  required>
                
                <br>
                
                <label for ="lastname"><b>Manufacturer</b></label>
                <input class="w3-input" type="text" placeholder="Manufacturer" name="manufacturer" required>
                
                <br>
                
                <label for ="description"><b>Description</b></label>
                <input  class="w3-input" type="text" placeholder="Description"
                       value="<?php echo $desc; ?>" name="desc" required>
                
                <br>
                
                <label for ="quantity"><b>Quantity</b></label><br>
                <input type="number"  name="qty" min = 1 max = 100 required>
               

                <br>
                <label for ="image"><b>Image</label></b><br>
                <input type="file" name="image" class="w3-input">
                 <br>                            
                <button class="w3-button logistixBlueBack w3-margin-bottom" type="submit" name="save">Add Product<style margin="8px !important"></style></button>  
            </div>
        </form>
</div>
      </div>
    </div>
  </div>
</div>

</body>
</html>