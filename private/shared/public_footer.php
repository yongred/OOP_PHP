      
    
    <footer>
      <p>Copyright <?php echo date('Y'); ?>, Member List</p>
    </footer>
    <script src="<?php echo url_for('/js/jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/js/main.js'); ?>" type="text/javascript"></script>
  </body>
</html>

<?php
db_disconnect($database);
?>