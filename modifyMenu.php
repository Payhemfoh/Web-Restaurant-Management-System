<div id="content" class="container-fluid bg-light rounded">   
    <br>     
    <form action="#" method="post">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th><font size='6'>Image</font></th>					
                    <th><font size='6'>Information</font></th>
                </tr>	
            </thead>
            <tbody>
                <tr>				
                    <td>
                        <div class="form-group">
                            <p>Current Picture:</p>
                            <img src="MenuManagement/chickenrice.jpg" class="img-thumbnail"><br><br>
                            <p>New Picture:</p>
                            <input type="file" name="newImg" accept="image/*" class="input-control">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="Chicken Rice">
                        </div>

                        <div class="form-group">
                            <label for="name">Ingredients:</label>
                            <textarea class="form-control" 
                            name="ingredients">Chicken,Rice,Cucumber,Soy Sauce,Cooking Oil, Chili Sauce</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Price(RM):</label>
                            <input type="number" step="0.01" class="form-control" name="price" value="7.00">
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description">Delicious chicken rice</textarea>
                        </div>

                        <input type="submit" value="Modify" class="btn btn-block btn-primaryLight btn-primary">
                        <a href="menuManagementModule.html" class="btn btn-block btn-primaryLight btn-primary">Cancel</a>						
                    </td>
                </tr>
            </tbody>        
        </table>			
    </form>
</div>