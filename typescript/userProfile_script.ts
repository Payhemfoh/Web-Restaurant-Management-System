import { inValidInput, validInput } from "./form_handle.js";

$(()=>{
    $("#btn_update").on("click",(e)=>{
        e.preventDefault();
        let id = e.target.getAttribute("value");
        let position = $("#position").val();
        let fname = $("#fname").val();
        let lname = $("#lname").val();
        let gender = $("input[name='gender']:checked").val();
        let birthday = $("#birthday").val();
        let phone = $("#phone").val() as string;
        let address = $("#address").val();
        let valid = true;

        //validation
        if(fname === ""){
            inValidInput($("#fname"),$("#fname-feedback"),"First Name should not be empty!");
            valid = false;
        }else{
            validInput($("#fname"),$("#fname-feedback"));
        }
        if(lname === ""){
            inValidInput($("#lname"),$("#lname-feedback"),"Last Name should not be empty!");
            valid = false;
        }else{
            validInput($("#lname"),$("#lname-feedback"));
        }
        if(gender == undefined){
            inValidInput($("#gender"),$("#gender-feedback"),"Gender should not be empty!");
            valid = false;
        }else{
            valid = false;
            inValidInput($("#gender"),$("#gender-feedback"),"Invalid gender!");
        }
        if(birthday === ""){
            inValidInput($("#birthday"),$("#birthday-feedback"),"Date Of Birth should not be empty!");
            valid = false;
        }else{
            validInput($("#birthday"),$("#birthday-feedback"));
        }
        if(address === ""){
            inValidInput($("#address"),$("#address-feedback"),"Address should not be empty!");
            valid = false;
        }else{
            validInput($("#address"),$("#address-feedback"));
        }
        if(phone === ""){
            inValidInput($("#phone"),$("#phone-feedback"),"Phone No should not be empty!");
            valid = false;
        }else{
             if(/^[0-9]{3}-[0-9]{7}$/.test(phone)){
                validInput($("#phone"),$("#phone-feedback"));
            }else{
                inValidInput($("#phone"),$("#phone-feedback"),"Phone No format is Invalid!!");
                valid = false;
            }
        }

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