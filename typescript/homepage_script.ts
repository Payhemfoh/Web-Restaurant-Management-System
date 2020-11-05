$(function(){
    //bind the buttons
    const dineIn = $("#dine-in");
    const takeAway = $("#take-away");
    const delivery = $("#delivery");

    //set click event for dine in button
    dineIn.on("click",function(){
        
    });

    //set click event for take away button
    takeAway.on("click",function(){
        let form = $("<form action='../webpage/orderList.php' method='get'><input type='hidden' name='service' value='take_away'></form> ");
        $("body").append(form);
        form.trigger("submit");
    });

    //set click event for delivery button
    delivery.on("click",function(){
        let form = $("<form action='../webpage/orderList.php' method='get'><input type='hidden' name='service' value='delivery'></form> ");
        $("body").append(form);
        form.trigger("submit");
    })

    
    $(".btn_edit").on("click",function(){
        (("#editModal") as any).modal();
    })
});