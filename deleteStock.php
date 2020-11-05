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
                            <img src="StockManagement/egg.jpg" class="img-thumbnail"><br><br>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" readonly class="form-control" name="name" value="Egg">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" readonly class="form-control" name="quantity" value="100">
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea readonly class="form-control" name="description">Fresh Egg</textarea>
                        </div>

                        <input type="submit" value="Delete" class="btn btn-block btn-primaryLight btn-primary">
                        <a href="stockManagementModule.html" class="btn btn-block btn-primaryLight btn-primary">Cancel</a>						
                    </td>
                </tr>
            </tbody>        
        </table>			
    </form>
</div>