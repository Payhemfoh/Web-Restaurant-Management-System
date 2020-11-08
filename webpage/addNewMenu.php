<form>
    <br><h3 class="text-center">Add new menu</h3><br>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name_input" class="form-control" name="name" value="">
        <div id="name-feedback"></div>
    </div>

    <div class="form-group">
        <label for="category">Category:</label>
        <select id="category_input" class="form-control" name="category">
    <?php
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        if($statement = $connect->prepare("SELECT * FROM menu_category")){
            $statement->execute();
            $result = $statement->get_result();

            while($row = $result->fetch_array()){
                echo '<option value='.$row['category_id'].'>'.$row['category_name'].'</option>';
            }
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
        
    ?>
        </select>
        <div id="category-feedback"></div>
    </div>

    <div class="form-group">
        <label for="name">Ingredients:</label>
        <textarea class="form-control" name="ingredients"></textarea>
        <div id="ingredient-feedback"></div>
    </div>

    <div class="form-group">
        <label for="price">Price(RM):</label>
        <input type="number" id="price_input" step="0.01" class="form-control" name="price" value="0.00">
        <div id="price-feedback"></div>
    </div>
    
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description_input" name="description"></textarea>
        <div id="description-feedback"></div>
    </div>

    <div class="form-group">
        <p>Picture:</p>
        <div class="form-group inputDnD">
            <label class="sr-only" for="inputFile">File Upload</label>
            <input type="file" name="newImg" accept="image/*" class="form-control-file text-primary font-weight-bold"
        if="newImg" onchange="readFile(this)" data-title = "Click Here or Drag and Drop to Upload File"><br>
        </div>
    </div>

    <button id="modal-submit" class="btn btn-block btn-primaryLight btn-primary">Add new Menu</button>
    <button id="modal-cancel" class="btn btn-block btn-primaryLight btn-primary">Cancel</button>						

</form>

