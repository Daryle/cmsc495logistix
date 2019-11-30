
  <div class="w3-container w3-padding-32">
    <button onclick="document.getElementById('id01').style.display='block'" class="w3-button logistixOrangeBack"><b>Add Product</b></button>
    <div id="id01" class="w3-modal">
      <div class="w3-modal-content">
        <div class="w3-container w3-light-grey">
        <a onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">X</a>
          <!-- <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span> -->
          <div class="row justify-content-center">
            <div class="logistixOrange">
              <h1>Add Product</h1>
            </div>
            <form method="POST" action="process.php" enctype="multipart/form-data">

              <div class="logistix-container">
                <input type="hidden" value="<?php echo $id; ?>" name="id">

                <label for="name"><b>Name</b></label>
                <input class="w3-input" type="text" placeholder="Product Name" value="<?php echo $name; ?>" name="name" required>

                <br>
                <label for="manufacturer"><b>Manufacturer</b></label>
                <input class="w3-input" type="text" placeholder="Manufacturer" name="manufacturer" required>

                <br>
                <label for="description"><b>Description</b></label>
                <input class="w3-input" type="text" placeholder="Description" value="<?php echo $desc; ?>" name="desc" required>

                <br>
                <label for="quantity"><b>Quantity</b></label><br>
                <input type="number" name="qty" min=1 max=100 required>

                <br>
                <label for="image"><b>Image</label></b><br>
                <input type="file" name="image" class="w3-input">

                <br>
                <button class="w3-button logistixBlueBack w3-margin-bottom" type="submit" name="save" data-target="#messageModal">Add Product</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

   <!-- Confirmation Message Modal-->
   <!-- <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Great!</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">The inventory has been updated successfully.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> -->
