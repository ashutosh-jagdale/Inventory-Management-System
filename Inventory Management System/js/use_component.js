$(document).ready(function(){
    var DOMAIN = "http://localhost/inv_sys/public_html/"
    addNewRow();
    $("#use").click(function(){
        addNewRow();
    })
   
    function addNewRow(){
        $.ajax({
            url : DOMAIN +"/includes/process.php",
            method : "POST",
            data : {useComponent : 1},
            success : function(data){
                $("#use_component").append(data);
                var n = 0;
                $(".number").each(function(){
                    $(this).html(++n);
                })
            }

        })
    }
    $("#remove").click(function(){
        $("#use_component").children("tr:last").remove();
    })
    $("#use_component").delegate(".coid","change",function(){
        var coid = $(this).val();
        //alert(coid);
        var tr = $(this).parent().parent();
        $.ajax({
            url : DOMAIN +"/includes/process.php",
            method : "POST",
            dataType : "json",
            data : {getQty : 1,id : coid},
            success : function(data){
                //console.log(data);
                //tr.find(".category_name").val(data["category_name"]);
                tr.find(".tqty").val(data["component_quantity"]);
                tr.find(".component_name").val(data["component_name"]);
                tr.find(".qty").val(1);
            }
        })
    })
    $("#use_component").delegate(".qty","keyup",function(){
        var qty = $(this);
        var tr = $(this).parent().parent();
        //alert(tr.find(".tqty").val());
        if(isNaN(qty.val())){
            alert("Please Enter numerical value");
            qty.val(0);
        }
        else{
            if((qty.val() - 0) > (tr.find(".tqty").val() - 0)){ //this is for issue faced saying alert even when quantity is sufficient
                alert("Insufficient quantity");
                qty.val(1);
            }
        }
    })
    //Use component on final addition
    $("#final_use").click(function(){
        $.ajax({
            url : DOMAIN +"/includes/process.php",
            method : "POST",
            data: $("#use_component_form").serialize(),
            success : function(data){
                if(data == "OUT_OF_STOCK"){
                    alert("The component is not available please ask admin to add the component");
                }
                else if(data == "COMPONENT_USED"){
                    window.location.href = DOMAIN + encodeURI("/view_inv.php?msg=The component is alloted and can be taken. Here you can check remaining components.");
                }
            }
        })
    })
});