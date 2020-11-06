<form action="#" method="post">
    <br><h3 class="text-center">Add new stock</h3><br>

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name_input" class="form-control" name="name">
        <div id="name-feedback"></div>
    </div>

    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity_input" class="form-control" name="quantity" value="0" step="0.01">
        <div id="quantity-feedback"></div>
    </div>
    
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description_input" name="description"></textarea>
        <div id="description-feedback"></div>
    </div> 

    <button id="modal-submit" class="btn btn-block btn-primaryLight btn-primary">Add new Stock</button>
    <button id="modal-cancel" class="btn btn-block btn-primaryLight btn-primary">Cancel</button>      		
</form>