$(function(){
    const submit = $("input[type='submit']");
    submit.on("click",function(e){
        e.preventDefault();

        //get user input
        let username = $("#username").val();
        let password = $("#pwd").val();

        //validate user input

        $.ajax("../php/login_process.php",{
            type:"POST",
            dataType:"HTML",
            data:{
                username:username,
                password:password
            },
            success:function(){},
            error:function(){},
        });
    })
});