$(()=>{
    $(".btn_delivered").on("click",(e)=>{
        e.preventDefault();
        let orderId = e.target.getAttribute("value");

        $.ajax({
            url:"../php/completePickup.php",
            method:"post",
            data:{orderId:orderId},
            success:(data)=>{
                $("#modal-title").text("Order Done");
                $(".modal-body").html(data);
                $(".modal-footer").html("");
                $("#btnAgain").attr("data-dismiss","modal");
                $("#btnAgain").on("click",()=>location.reload());
                ($("#modal") as any).modal();
                setTimeout(()=>$("#btnAgain").trigger("click"),1000);
            },
        });
    });
});