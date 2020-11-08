$(function(){
    const orderQty = $("#orderQty");

    $("#btnLess").on("click",function(e){
        e.preventDefault();
        let qty = (orderQty.val() as number);
        if(qty<=1){
            orderQty.val("1");
            alert("The minimum order is 1.");
        }else{
            orderQty.val(--qty);
        }
    });

    $("#btnMore").on("click",function(e){
        e.preventDefault();
        let qty = (orderQty.val() as number);
        if(qty>=10){
            orderQty.val("10");
            alert("The maximum order each time is 10.");
        }else{
            orderQty.val(++qty);
        }
    });
});