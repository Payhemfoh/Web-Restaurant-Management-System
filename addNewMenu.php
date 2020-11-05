<div id="content" class="container-fluid bg-light rounded">        
    <form action="#" method="post">
        <br><h3 class="text-center">Add new menu</h3><br>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="">
        </div>

        <div class="form-group">
            <label for="name">Ingredients:</label>
            <textarea class="form-control" name="ingredients"></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price(RM):</label>
            <input type="number" step="0.01" class="form-control" name="price" value="">
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="form-group">
            <p>Picture:</p>
            <input type="file" name="newImg" accept="image/*" class="input-control">
        </div>

        <input type="submit" value="Add Menu" class="btn btn-block btn-primary">
        <a href="menuManagementModule.html" class="btn btn-block btn-warning">Cancel</a>
        <br><br>						
    
    </form>
</div>