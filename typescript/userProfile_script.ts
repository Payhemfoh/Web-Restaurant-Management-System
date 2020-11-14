$(()=>{
    $("#btn_update").on("click",(e)=>{
        e.preventDefault();
        let id = e.target.getAttribute("value");
        let position = $("#position").val();
        let fname = $("#fname").val();
        let lname = $("#lname").val();
        let gender = $("input[name='gender']:checked").val();
        let birthday = $("#birthday").val();
        let phone = $("#phone").val();
        let address = $("#address").val();
        let valid = true;

        //validation
        
        if(valid){
            $.ajax({
                url:"../php/updateUserProfile.php",
                method:"post",
                data:{
                    id:id,
                    position:position,
                    fname:fname,
                    lname:lname,
                    gender:gender,
                    birthday:birthday,
                    phone:phone,
                    address:address
                },
                success:(data)=>{
                    $("#modal-title").text("Update Complete");
                    $(".modal-body").html(data);
                    $(".modal-footer").html("");
                    $("#btnAgain").attr("data-dismiss","modal");
                    $("#btnAgain").on("click",()=>location.reload());
                    ($("#modal") as any).modal();
                },
            });
        }
    });
});