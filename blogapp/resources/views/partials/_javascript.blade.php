   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    var element=document.getElementById('LogOut-link');
    if(typeof (element) !=='undefined' && element!=null){
    document.getElementById('LogOut-link').addEventListener('click',function(event){
        event.preventDefault();
        document.getElementById('LogOut-form').submit();
      },false);
    }
    </script>