import { errorModal } from "./errorFunction.js";
import { inValidInput, validInput } from "./form_handle.js";

$(()=>{
    $("#send-mail").on("click",(e)=>{
        e.preventDefault();

        //get user input
        let username = $("#username").val();
        let email = $("#email").val();
        let content = $("#content").val();
        let valid = true;

        if(username === ""){
            inValidInput($("username"),$("username-feedback"),"Username should not be empty!");
            valid = false;
        }else{
            validInput($("username"),$("username-feedback"));
        }

        if(email === ""){
            inValidInput($("email"),$("email-feedback"),"Email should not be empty!");
            valid = false;
        }else{
            validInput($("email"),$("email-feedback"));
        }

        if(content === ""){
            inValidInput($("content"),$("content-feedback"),"Content should not be empty!");
            valid = false;
        }else{
            validInput($("content"),$("content-feedback"));
        }

        if(valid){
            $.ajax("../php/contact_process.php",{
                method:"post",
                dataType:"html",
                data:{
                    username:username,
                    email:email,
                    content:content
                },
                success: (data)=>{
                    $("#contact_form").html(data);
                },
                error:errorModal
            });
        }

    })
});