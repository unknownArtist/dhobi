            </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Handlebars -->
        <script src="http://cloud.github.com/downloads/wycats/handlebars.js/handlebars-1.0.0.beta.6.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- Ajax form validation -->
        <script src="ajax/form_validation.js" type="text/javascript"></script>

        <script type="text/javascript">
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        $("#datepicker").datepicker({
            startDate: today 
        });
        $("#datepicker1").datepicker({
            startDate: today 
        });

            $('#timepicker').timepicker();
            $('#timepicker1').timepicker();

        </script>
         <script>
         var total;
            $(document).ready(function(){
                $("#calculate").click(function(e){
                    e.preventDefault();
                        $("#totalamount").val(" ");
                        $("#totalamountdiv").empty();
                        calculateSum();
                    });

                
                
                });
            function calculateSum()
            {
                var total = 0;
                var i = 0

                for (i = 0; i < 6; i++)
                {

                     total +=  parseFloat($("#quantity_price"+i).data('price') * $("#quantity_price"+i).val());
                    
                }
                $("#totalamount").val(total);
                $("#totalamountdiv").append('$'+total);


            }
</script>
    </body>
  
</html>