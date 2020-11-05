<div id="content" class="container-fluid bg-light rounded">        
    <form action="#" method="post">
        
        <br><h3 class="text-center">Add new stock</h3><br>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="">
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" name="quantity" value="">
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="form-group">
            <p>New Picture:</p>
            <input type="file" name="newImg" accept="image/*" class="input-control">
        </div>

        <input type="submit" value="Modify" class="btn btn-block btn-primary">
        <a href="stockManagementModule.html" class="btn btn-block btn-warning">Cancel</a>						
        <br><br>      		
    </form>
</div>