import { errorModal } from "./errorFunction.js";
import { inValidInput, showPasswordSetting, validInput } from "./form_handle.js";

$(function(){
    //register ajax call(when register button is clicked)
    $("#btn_register").on("click",function(e){
        //cancel default submit function
        e.preventDefault();

        //validate all input
        let fname = ($("#fname").val() as string).trim();
        let lname = ($("#lname").val() as string).trim();
        let gender = $("input[name='gender']:checked").val();
        let birthday = ($("#birthday").val() as string).trim();
        let phone = ($("#phone").val() as string).trim();
        let email = ($("#email").val() as string).trim();
        let username = ($("#username").val() as string).trim();
        let password = ($("#password").val() as string).trim();
        let confirmPassword = ($("#confirm_password").val() as string).trim();
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
            if(gender==="male"){
                gender = 'M';
                validInput($("#gender"),$("#gender-feedback"));
            }else if(gender==="female"){
                gender = 'F';
                validInput($("#gender"),$("#gender-feedback"));
            }else{
                valid = false;
                inValidInput($("#gender"),$("#gender-feedback"),"Invalid gender!");
            }
        }

        if(birthday === ""){
            inValidInput($("#birthday"),$("#birthday-feedback"),"Date Of Birth should not be empty!");
            valid = false;
        }else{
            validInput($("#birthday"),$("#birthday-feedback"));
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

        if(email === ""){
            inValidInput($("#email"),$("#email-feedback"),"Email should not be empty!");
            valid = false;
        }else{
            //the regex to check email format
            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))
            {
                validInput($("#email"),$("#email-feedback"));
            }else{
                inValidInput($("#email"),$("#email-feedback"),"The email format is Invalid!");
                valid = false;
            }
            
        }

        if(username === ""){
            inValidInput($("#username"),$("#username-feedback"),"Username should not be empty!");
            valid = false;
        }else{
            validInput($("#username"),$("#username-feedback"));
        }

        if(password === ""){
            inValidInput($("#password"),$("#password-feedback"),"Password should not be empty!");
            valid = false;
        }else{
            validInput($("#password"),$("#password-feedback"));
        }
        
        if(confirmPassword === ""){
            inValidInput($("#confirm_password"),$("#confirmPassword-feedback"),"Confirm Password should not be empty!");
            valid = false;
        }else{
            if(confirmPassword === password){
                validInput($("#confirm_password"),$("#confirmPassword-feedback"));
            }else if(password === ""){
                inValidInput($("#confirm_password"),$("#confirmPassword-feedback"),"Password is not filled!");
                valid = false;
            }else{
                inValidInput($("#confirm_password"),$("#confirmPassword-feedback"),"Password do not match the Confirm Password!");
                valid = false;
            }
            
        }


        if(valid){
            //perform post ajax call using jquery
            $.ajax("../php/register_process.php",{
                type: "POST",
                //return datatype from the processing code
                dataType: "HTML",
                //the data to be passed to the processing code
                data: {
                    fname:fname,
                    lname:lname,
                    gender:gender,
                    birthday:birthday,
                    phone:phone,
                    email:email,
                    username:username,
                    password:password,
                    confirmPassword:confirmPassword
                },
                //action after the ajax call is success
                success: function(data,status,xhr){
                    $("#modal-title").text("Register Status");
                    $(".modal-body").html(data);
                    $("#btnAgain").attr("data-dismiss","modal");
                    ($("#modal") as any).modal();
                } ,
                //action after the ajax call is failed
                error:  errorModal
            });
        }
    });

    showPasswordSetting($("#password"),$("#showpassword"));
    showPasswordSetting($("#confirm_password"),$("#showconfirmpassword"));
});
