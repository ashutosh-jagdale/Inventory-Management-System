$(document).ready(function(){
    var DOMAIN = "http://localhost/inv_sys/public_html/"
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
       
    //manage categories
    manageCategory(1);
        function manageCategory(pn){
            $.ajax({
                url : DOMAIN +"/includes/process.php",
                method : "POST",
                data : {manageCategory:1,pageno:pn},
                success : function(data){
                    $("#get_category").html(data);
                }
            })
        }
        var pd=1;
        $("body").delegate(".page-link","click",function f1(){
           // var pn ;
            pn=pd= $(this).attr("pn");
        
            manageCategory(pn);
        })

       
        $("body").delegate(".del_cat","click",function()
        {
            
        
            var did = $(this).attr("did");
            if(confirm("Do you really want to delete the category?"))
            {
                $.ajax({
                    url : DOMAIN +"/includes/process.php",
                    method : "POST",
                    dataType : "json",

                    data : {deleteCategory:1,id:did},
                    success : function(data)  //meaning of success is best utilised here  as cat that cannot be deleted generate error on deleteing , so error in srver side makes our ajax call
                    {
                       
                        if (data["msg"]=="DELETED") 
                        {
                            if(data["values"]%5==0)
                            {
                                pd=data["values"]/5;
                                manageCategory(pd);

                            }

                            
                            //manageCategory(pn);
                            //alert("Deleted Successfully");
                          //  window.location.href = DOMAIN + encodeURI("/manage_categories.php?msg=Category deleted");
                            //manageCategory(1);
                        }
                        else
                        {
                            alert("some error");
                        }
                    },
                    
                     error: function(data)
                     {
                        alert("This category has a component in the database and hence cannot be deleted");
        
                     }

                })
            }
            else{
                //alert("No");
            }
           
            manageCategory(pd);
           
        })
      
     
        /********************************this is to view inventory***************************/
        
        //View inventory
        viewInventory(1);
        function viewInventory(pn){
            $.ajax({
                url : DOMAIN +"/includes/process.php",
                method : "POST",
                data : {viewInventory:1,pageno:pn},
                success : function(data){
                    //alert("Function success");
                    //alert(data);
                    $("#view_inv").html(data);
                }
            })
        }

        $("body").delegate(".page-link","click",function(){
            var pn = $(this).attr("pn");
            //alert(pn);
            viewInventory(pn);
        })
        



        //for update 
        $("body").delegate(".edit_cat","click",function(){
            var eid = $(this).attr("eid");
            //alert("Just above ajax and eid is");
           // alert(eid);
            $.ajax({
                
                url: DOMAIN + "/includes/process.php",
                method : "POST",
                dataType : "json",
                data : {updateCategory:1,id:eid},
                success : function (data) {
                    //alert(data);
                    console.log(data);
                    $("#cid").val(data["cid"]);
                    $("#update_category").val(data["category_name"]);
                }
            })
        })

        $("#update_category_form").on("submit",function(){
            var status2=false;
            var cat_name = $("#update_category");
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
                    data : $("#update_category_form").serialize(),
                    success : function(data){
                        //alert(data);
                        window.location.href = DOMAIN + encodeURI("/manage_categories.php?msg=Category updated");
                    }
                })
            }
        })
        //manage components
        manageComponent(1);
        function manageComponent(pn){
            $.ajax({
                url : DOMAIN +"/includes/process.php",
                method : "POST",
                data : {manageComponent:1,pageno:pn},
                success : function(data){
                    //alert("Function success");
                    //alert(data);
                    $("#get_component").html(data);
                }
            })
        }
        $("body").delegate(".page-link","click",function(){
            var pn = $(this).attr("pn");
            //alert(pn);
            manageComponent(pn);
        })
        //To delete the component
        $("body").delegate(".del_component","click",function(){
            var did = $(this).attr("did");
            //alert(did); //Verified OK
            if(confirm("Do you really want to delete the category?")){
                $.ajax({
                    url : DOMAIN +"/includes/process.php",
                    method : "POST",
                    data : {deleteComponent:1,id:did},
                    success : function(data){
                        $("#get_component").html(data);
                        if (data == "DELETED") {
                            //alert("Deleted Successfully");
                            window.location.href = DOMAIN + encodeURI("/manage_components.php?msg=Component deleted");
                            //manageComponent(1);    
                        }
                        else{
                            //alert("This category has a component in the database and hence cannot be deleted");
                        }
                    }
                })
            }
            else{
                //alert("No");
            }
        })
        $("body").delegate(".edit_component","click",function(){
            var eid = $(this).attr("eid");
            //alert("Just above ajax and eid is");
            //alert(eid);
            $.ajax({
                
                url: DOMAIN + "/includes/process.php",
                method : "POST",
                dataType : "json",
                data : {updateComponent:1,id:eid},
                success : function (data) {
                    console.log(data);
                    $("#coid").val(data["coid"]);
                    $("#update_component").val(data["component_name"]);
                    $("#select_category").val(data["cid"]);
                    $("#component_quantity").val(data["component_quantity"]);
                }
            })
        })
        //This is to update component
        $("#update_component_form").on("submit",function(){
            $.ajax({
                url : DOMAIN + "/includes/process.php",
                method : "POST",
                data : $("#update_component_form").serialize(),
                success : function(data){
                    if (data == "UPDATED") {
                        //alert("Component updated");
                        window.location.href = DOMAIN + encodeURI("/manage_components.php?msg=Component updated");
                        //$('#update_component_form').DataTable().reload(null, false);                      
                    }
                    else{
                        alert(data);
                    }
                }
            })
        })


        viewSearch(1);
        function viewSearch(pn)
        {

            $('#search_text').keyup(function()  //when user is typing
            {
            
                var txt=$(this).val();
               
                if(txt!="")
                {

                    $.ajax({
                    url:  DOMAIN +"/includes/process.php",
                    method : "POST",
                    data:{search:txt,serach_c:1,pageno:pn},
                    dataType:"text",
                    success:function(data)
                    {
                      // alert(data);
                        //$("#view_inv").html("");
                        $("#view_inv").html(data); 
                        
                    }
                            


                })
            }
            else
            {

               viewInventory(1);   //again showinf full inventory


            }

        })
    }

    //action performed on clicking pages no(pagination)
    $("body").delegate(".page-link","click",function()      //this part just changing pages(pagination)
    {
       
            var pn = $(this).attr("pn");
            viewSearch(pn);
            
    })
        

        




        
        
})
