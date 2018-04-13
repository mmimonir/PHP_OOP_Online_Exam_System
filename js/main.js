$(function() {
    //For User Registration
    $("#regsubmit").click(function() {
        var name = $("#name").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var email = $("#email").val();
        $.ajax({
            type: "POST",
            url: "getregister.php",
            data: { name: name, username: username, password: password, email: email },
            dataType: "text",
            success: function(data) {
                $("#state").html(data);
            }

        });
        return false;
    });
    //For User Login
    $("#loginsubmit").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();        
        $.ajax({
            type: "POST",
            url: "getlogin.php",
            data: { email: email, password: password },
            dataType: "text",
            success: function(data) {
                if ($.trim(data)=="empty") {
                	$(".empty").show();
                	setTimeout(function(){
                		$(".empty").fadeOut();
                	},3000);
                } else if($.trim(data)=="disable") {                	
                	$(".disable").show();
                	setTimeout(function(){
                		$(".disable").fadeOut();
                	},3000);
                }
                else if($.trim(data)=="error") {                	
                	$(".error").show();
                	setTimeout(function(){
                		$(".error").fadeOut();
                	},3000);                	
                }else{
                	window.location = "exam.php";
                }
            }

        });
        return false;
    });
});
