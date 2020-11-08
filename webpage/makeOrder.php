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
                        <p>Picture:</p>
                        <img src="../images/MenuManagement/chickenrice.jpg" class="img-thumbnail"><br><br>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" readonly class="form-control" name="name" value="Chicken Rice">
                    </div>

                    <div class="form-group">
                        <label for="name">Ingredients:</label>
                        <textarea readonly class="form-control" 
                        name="ingredients">Chicken,Rice,Cucumber,Soy Sauce,Cooking Oil, Chili Sauce</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price(RM):</label>
                        <input type="number" readonly step="0.01" class="form-control" name="price" value="7.00">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea readonly class="form-control" name="description">Delicious chicken rice</textarea>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button id="btnLess" class="btn btn-count btn-outline-primary">&lt;</button>
                            </div>
                            <input type="number" id="orderQty" class="numberInput form-control col-md-2 text-center" name="quantity" value = "1" readonly>
                            <div class="input-group-postpend">
                                <button id="btnMore" class="btn btn-count btn-outline-primary">&gt;</button>
                            </div>
                        </div>
                    </div>					
                </td>
            </tr>
        </tbody>        
    </table>			
</form>
<script src="../javascript/orderControl.js"></script>