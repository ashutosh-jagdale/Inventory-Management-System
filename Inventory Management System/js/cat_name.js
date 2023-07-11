//for getting category name
            var DOMAIN = "http://localhost/inv_sys/public_html/";
                    $(document).ready(function()
                    {
                        $("#occur").change(function()
                        {
                            var id=$(this).val();
                            

                            $.ajax({
                                 url : DOMAIN+"/includes/ret_catname.php",
                                method:"POST",
                                data:{val:id},
                                datatype:"text",
                                success:function(data)
                                {
                                    
                                
                                    $('#name').html(data);
                                }

                               


                            })

                        


                        })

                    })

       