    $(document).ready(function(){
        var DOMAIN = "http://localhost/inv_sys/public_html/"
        //This function is for registration form...
        $("#register_form").on("submit",function(){
            var status = false;
            var name = $("#username");
            var email = $("#email");
            var pass1 = $("#Password1");
            var pass2 = $("#Password2");
            var type = $("#usertype");
            //var n_patt = new RegExp(/^[A-Za-z ]++$/);
            var e_patt = new RegExp(/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
            if(name.val()== ""){
                name.addClass("border-danger");
                $("#u_error").html("<span class = 'text-danger'>Please Enter Name</span>");
                status = false;
            }
            else{
                name.removeClass("border-danger");
                $("#u_error").html("<span class = 'text-success'>Valid Name</span>");
                status = true;
            }
            if(!e_patt.test(email.val())){
                email.addClass("border-danger");
                $("#e_error").html("<span class = 'text-danger'>Please enter valid email address</span>");
                status = false;
            }
            else{
                email.removeClass("border-danger");
                $("#e_error").html("<span class = 'text-success'>Valid email</span>");
                status = true;
            }
            
            if(pass1.val()== ""){
                pass1.addClass("border-danger");
                $("#p1_error").html("<span class = 'text-danger'>Please Enter Password</span>");
                status = false;
            }
            else{
                pass1.removeClass("border-danger");
                pass1.addClass("border-success");
                $("#p1_error").html(" ");
                status = true;
            }
            if(pass2.val()== ""){
                pass2.addClass("border-danger");
                $("#p2_error").html("<span class = 'text-danger'>Please Re-Enter Password</span>");
                status = false;
            }
            else{
                if(pass1.val()!=pass2.val()){
                    pass2.addClass("border-danger");
                    $("#p2_error").html("<span class = 'text-danger'>Passwords do not match, enter the password again.</span>");
                    status = false;
                }
                else if(pass1.val()==pass2.val() && status==true) {
                    pass2.removeClass("border-danger");
                    $("#p2_error").html("<span class = 'text-success'>Passwords matched.</span>");
                    $.ajax({
                        url : DOMAIN + "/includes/process.php",
                        method : "POST",
                        data : $("#register_form").serialize(),
                        success : function(data){
                            if (data == "EMAIL_ALREADY_EXISTS") {
                                alert("The email you have entered is already registered");
                            }
                            else if (data =="SOME_ERROR") {
                                alert("Some error occured while registering try again!!");   
                            } 
                            else {
                                //alert("Registration success!");
                                window.location.href = DOMAIN + encodeURI("/index.php?msg=Registration successful.");
                            }
                        }
                    })  
                }
            }
            if(type.val()== ""){
                type.addClass("border-danger");
                $("#o_error").html("<span class = 'text-danger'>Please Enter Name</span>");
                status = false;
            }
            else{
                type.removeClass("border-danger");
                type.addClass("border-success");
                $("#o_error").html("<span class = 'text-success'></span>");
                status = true;
            }

        })
        //This function is for login page...
        $("#login_form").on("submit",function(){
            var status1 = false;
            var login_email = $("#log_email");
            var login_password = $("#log_password");
            var e_patt = new RegExp(/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
            if(!e_patt.test(login_email.val())){
                login_email.addClass("border-danger");
                $("#e_error").html("<span class = 'text-danger'>Please enter valid email address</span>");
                status1 = false;
            }
            else{
                login_email.removeClass("border-danger");
                $("#e_error").html("<span class = 'text-success'>Valid email</span>");
                status1 = true;
            }
            
            if(login_password.val()== ""){
                login_password.addClass("border-danger");
                $("#lp_error").html("<span class = 'text-danger'>Please Enter Password</span>");
                status1 = false;
            }
            else{
                login_password.removeClass("border-danger");
                //pass1.addClass("border-success");
                $("#lp_error").html(" ");
                status1 = true;
            }         
            if (status1) {
                $.ajax({
                    url : DOMAIN + "/includes/process.php",
                    method : "POST",
                    data : $("#login_form").serialize(),
                    success : function(data){
                        if (data == "NOT_REGISTERED") {
                            alert("The email you have entered is not registered");
                        }
                        else if (data =="PASSWORD_NOT_MATCHED") {
                            alert("The password you have entered is incorrect.");   
                        } 
                        else{
                            console.log(data);
                            //alert(data);
                            if(data==1){
                                window.location.href = DOMAIN + encodeURI("/dashboard.php?msg=Login success");
                            }
                            else if(data == 2){
                                window.location.href = DOMAIN + encodeURI("/otherdashboard.php?msg=Login success");
                            }
                            
                        }
                    }
                })
            }
        })//End of login
        //Category part
        fetch_category();
        function fetch_category(){
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : {getCategory:1},
                success : function(data){
                    //alert(data);
                    var choose = "<option value=''>Choose category</option>";
                    $("#select_category").html(choose+data);
                }
                
            })
        }
        //Add category
        $("#category_form").on("submit",function(){
            var status2=false;
            var cat_name = $("#category_name");
            if(cat_name.val()== ""){
                cat_name.addClass("border-danger");
                $("#cat_error").html("<span class = 'text-danger'>Please Enter category's name</span>");
                status2 = false;
            }
            else{
                cat_name.removeClass("border-danger");
                $("#cat_error").html("<span class = 'text-success'></span>");
                status2 = true;
            }
            if(status2){
                $.ajax({
                    url : DOMAIN + "/includes/process.php",
                    method : "POST",
                    data : $("#category_form").serialize(),
                    success : function(data){
                        if (data == "CATEGORY_ADDED") {
                            //alert("Category you entered is sucessfully added");
                            window.location.href = DOMAIN + encodeURI("/dashboard.php?msg=Category added");
                        } 
                        else{
                            console.log();
                            alert("The category you have added might exist already.");
                        }
                        fetch_category();
                    }
                })
            }
        });
        //add component
        $("#component_form").on("submit",function(){
            $.ajax({
                url : DOMAIN + "/includes/process.php",
                method : "POST",
                data : $("#component_form").serialize(),
                success : function(data){
                    if (data == "COMPONENT_ADDED") {
                        //alert("Component you entered is sucessfully added");
                        window.location.href = DOMAIN + encodeURI("/dashboard.php?msg=Component added");
                        $("#select_category").val("");
                        $("#component_name").val("");
                        $("#component_quantity").val("");
                    } 
                    else{
                        console.log();
                        alert(data);
                    }
                }
            })
        })


         //Edit profile  ****************************



       // on clicking edit link not button in dashboard.php this ajax call to php to get all fileds filled initially 
        $("#edit").on("click",function()
        {
            $.ajax({
                    url : DOMAIN + "/includes/process.php",
                    method : "POST",
                    data : {val:1},  //passing input info and val for entering
                    success : function(data)
                    {
                      
                       $("#edit_form").html(data);  //getting data in edit_form to display in form oder
                    }
                })  


        });




        //if wish we can edit in by default data from above ajax call . On submit 
         $("#edit_form").on("submit",function()
         {

        
            var status = false;
            var user=$("#username1");
            var email = $("#email1");
          
            //var pass1 = $("#Password1");
          //  var pass2 = $("#Password2");
            //var n_patt = new RegExp(/^[A-Za-z ]++$/);
            var e_patt = new RegExp(/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
           
            if(!e_patt.test(email.val()))
            {
                email.addClass("border-danger");
                $("#e_error").html("<span class = 'text-danger'>Please enter valid email address</span>");
                status = false;
            }

            else
            {
                email.removeClass("border-danger");
                $("#e_error").html("<span class = 'text-success'>Valid email</span>");
                status = true;
            }
            
            if(status) 
            {
                
                   
                    $.ajax({
                        url : DOMAIN + "/includes/process.php",
                        method : "POST",
                        data : $("#edit_form").serialize(),  //passing inputs info  for re placing users detail
                        success : function(data)
                        {
                            window.location.href = DOMAIN + encodeURI("/dashboard.php");
                        }
                    })  
                }
            }

            
        )
})
