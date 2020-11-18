        <div class="container-fluid" style="padding: 0;">
            <div class="footer">
                <ul>
                    <li>Read Our Story</li>
                    <li>Our Social Media </li>
                    <li>Get Ahold Of Us</li>
                    <li>Costumers Say </li>
                    <li>Location</li>
                </ul>
            </div>
        </div>
        
        <script type="text/javascript" src="<?php echo $js; ?>jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $js; ?>popper.min.js"></script>
        <script type="text/javascript" src="<?php echo $js; ?>bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $js; ?>bootbox.min.js"></script>
        <script type="text/javascript" src="<?php echo $js; ?>bootstrap-tagsinput.js"></script>
		<script type="text/javascript" src="<?php echo $js; ?>front.js"></script>
        <script>
        // Start Notification System

        // load new notifications
        $('#notifs').click(function(){
            $('.notifs-count').text('');
            load_unseen_item_comments_notifs('yes');
        });

        // updating the view with notifications using ajax
        function load_unseen_item_comments_notifs(view = ''){
            $.ajax({
                url: "fetch_item_comments_notifs.php",
                method: "POST",
                data: {view: view},
                dataType: "JSON",
                success: function(data){
                    console.log('done');
                    $('#notifs-list .dropdown-menu').html(data.comment_item_notifs);
                    if(data.unseen_comment_item_notifs > 0){
                        $('#notifs-list').addClass('show');
                        $('.notifs-count').text(data.unseen_comment_item_notifs);
                    }
                }
            });
        }

        load_unseen_item_comments_notifs();
        
        //setInterval(function(){
        //    load_unseen_item_comments_notifs();
        //}, 1000);
        
        // Ends Notification System

        // Change Language
        $('.lang').click(function() {
            var lang = $(this).data('lang');
            $.ajax({
                url:"includes/functions/functions.php",
                type:"POST",
                data:{lang:lang},
                success:function() {
                    window.location.reload();

                }
            });
        });

        </script>
	</body>
</html>
