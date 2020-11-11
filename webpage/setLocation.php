<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Delivery</title>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD1DxO02YcvRjKIgmOQoNoU1neglwQr0w&v=weekly" defer></script>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__));?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <form>
                <br><h3 class="text-center">Delivery</h3><br>
                <div class="form-group">
                    <label for="location">Your Location</label><br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button id="btn_setLocation" class="btn btn-outline-info">O</button>
                        </div>
                    
                        <input type="text" class="form-control" name="location" id="location">
                    </div>
                </div>
                
                <div id="map" class="alert alert-info" style="height:500px;">
                </div>

                <button id="submit-address" class="btn btn-block btn-primary">Proceed</button>
                <br>
            </form>
        </div>
        <br/>

        <?php printModal(); ?>
        <?php printFooter();?>

        <script type="module" src="../javascript/searchLocation_script.js"></script>
    </body>
</html>