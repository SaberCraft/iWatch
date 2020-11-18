$(function () {

    'use strict';

    // Get url parameter jquery Or How to Get Query String Values In js
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null){
           return null;
        }
        else{
           return decodeURI(results[1]) || 0;
        }
    };

    function setSelectionRange(input, selectionStart, selectionEnd) {
        if (input.setSelectionRange) {
          input.focus();
          input.setSelectionRange(selectionStart, selectionEnd);
        } else if (input.createTextRange) {
          var range = input.createTextRange();
          range.collapse(true);
          range.moveEnd('character', selectionEnd);
          range.moveStart('character', selectionStart);
          range.select();
        }
      }
      
      function setCaretToPos(input, pos) {
        setSelectionRange(input, pos, pos);
      }

      // search
      $('#search').on('show.bs.collapse', function () {
        console.log('search');
      });

    // Switch Bitween Login And Signup
    $('.login-page h1 span').click(function() {
        if ($(this).data('class') == 'login') {
            $(this).addClass('log').siblings().removeClass('sign');
            $('a.logg').css('color', '#0968ce');
            $('a.siggn').css('color', 'white');
        }else {
            $(this).addClass('sign').siblings().removeClass('log');
            $('a.siggn').css('color', 'green');
            $('a.logg').css('color', 'white');
        }
        $('.login-page form').hide();
        $('.' + $(this).data('class')).fadeIn(200);
    });

    // Load User Items In Profile Page
    $("#user_items_loading").load("includes/ajax/fetch_user_items.php");

    // Item Galery
    $('.sec-img').on('click', function() {
        $(this).parent().siblings().find('.img-thumbnail').removeClass('active');
        $(this).children().addClass('active');
        $('#main-img').attr('src', $(this).data('image'));
    });
      
    // Display Filtration in Profile Page
    $('#filtrer').click(function() {
        $('#userItems').addClass('col-md-2');
        $('#UserItems').attr('class', 'col-md-8 user-items');
        $('.card-deck').find('.card-img-top').css("height", "160px");
        $('#userFiltration').removeClass('hide');
    });

    // Hide Filtration In Profile Page
    $('#closeFilter').click(function() {
        $('#userItems').removeClass('col-md-2');
        $('#UserItems').attr('class', 'col-md-10 user-items');
        $('#userFiltration').addClass('hide');
        window.location.reload();
    });

    // Add to cart
    function addToCart(id){
        var item_id = id;
        var item_quantity = 1;
        var action = "add"; 
        $.ajax({  
            url:"includes/ajax/cart_actions.php",  
            method:"POST",  
            data:{  
                item_id:item_id,
                item_quantity:item_quantity,  
                action:action  
            },  
            success:function(data)  
            {  
                $('.cart-count').text(data); 
            }  
        }); 
    }
    
    // Fetch Index Items for min price
    $('#all_filter_price').change(function(){
        var price = $(this).val();
        $.ajax({  
            url:"includes/ajax/filter_price_items.php",  
            type:"POST",
            dataType:"JSON",  
            data:{price: price},  
            success:function(data){  
                $("#price_range").text(data.count + " montres sous prix: " + price + ".00 DZD" );
                $('#newest_items_loading').fadeIn(600).html(data.items);   
            }  
       });  
    });

    // Fetch Category Items for min price
    $('#cat_filter_price').change(function(){
        var price = $(this).val();
        var catId = $.urlParam('markId');
        $.ajax({  
            url:"includes/ajax/filter_price_items.php",  
            method:"POST",
            dataType:"JSON",  
            data:{price: price, catId: catId},  
            success:function(data){ 
                $("#price_range").text(data.count + " montres sous prix: " + price + ".00 DZD" );
                $('#items_loading').fadeIn(600).html(data.items);   
            }  
       });  
    });

    // Fetch User Items for min price
    $('#user_filter_price').change(function(){
        var price = $(this).val();
        var userId = $(this).data('userid');
        $.ajax({  
            url:"includes/ajax/filter_price_items.php",  
            method:"POST",
            dataType:"JSON",  
            data:{price: price, userId: userId},  
            success:function(data){  
                $("#price_range").text(data.count + " montres sous prix: " + price + ".00 DZD" );
                $('#user_items_loading').fadeIn(600).html(data.items); 
            }  
       });  
    });

    // Fetch Member Items for min price
    $('#member_filter_price').change(function(){
        var price = $(this).val();
        var memberId = $.urlParam('mId');
        $.ajax({  
            url:"includes/ajax/filter_price_items.php",  
            method:"POST", 
            dataType:"JSON", 
            data:{price: price, memberId: memberId},  
            success:function(data){  
                $("#price_range").text(data.count + " montres sous prix: " + price + ".00 DZD" );
                $('#member_items_loading').fadeIn(600).html(data.items);  
            }  
       });  
    });

    // Fetch Index Items for name
    $('#all_filter_name').keyup(function(){
        var name = $(this).val();
        $.ajax({  
            url:"includes/ajax/filter_name_items.php",  
            method:"POST",
            dataType:"JSON",  
            data:{name: name},  
            success:function(data){  
                $('#newest_items_loading').fadeIn(600).html(data.items);
                $('#name_filter_result').text(data.count + " résultats");  
            }  
       });  
    });

    // Fetch Category Items for name
    $('#cat_filter_name').keyup(function(){
        var name = $(this).val();
        var catId = $.urlParam('markId');
        $.ajax({  
            url:"includes/ajax/filter_name_items.php",  
            method:"POST",
            dataType:"JSON",  
            data:{name: name, catId: catId},  
            success:function(data){  
                $('#items_loading').fadeIn(600).html(data.items);
                $('#name_filter_result').text(data.count + " résultats");  
            }  
       });  
    });

    // Fetch User Items for name
    $('#user_filter_name').keyup(function(){
        var name = $(this).val();
        var userId = $(this).data('userid');
        $.ajax({  
            url:"includes/ajax/filter_name_items.php",  
            method:"POST",
            dataType:"JSON",  
            data:{name: name, userId: userId},  
            success:function(data){  
                $('#user_items_loading').fadeIn(600).html(data.items);
                $('#name_filter_result').text(data.count + " résultats");  
            }  
       });  
    });

    // Fetch Member Items for name
    $('#member_filter_name').keyup(function(){
        var name = $(this).val();
        var memberId = $(this).data('memberid');
        $.ajax({  
            url:"includes/ajax/filter_name_items.php",  
            method:"POST",
            dataType:"JSON",  
            data:{name: name, memberId: memberId},  
            success:function(data){  
                $('#member_items_loading').fadeIn(600).html(data.items);
                $('#name_filter_result').text(data.count + " résultats");  
            }  
       });  
    });

    // Load Member Items In Member Profile Page
    $("#member_items_loading").load("includes/ajax/fetch_member_items.php", {member_id: $.urlParam('mId')});

    // Start New Article Modal
    $('#newAdBtn').click(function() {
        $('#newAd').modal({
            backdrop: 'static',
            keyboard: false
        }),
        $('#newAd').modal('handleUpdate')
    });

    $('.live-name').keyup(function() {
        if ($(this).val() == '') {
            $('.live-preview .card-title').text('Titre');
        } else {
            $('.live-preview .card-title').text($(this).val());
        } 
    });

    $('.live-price').keyup(function() {
        if ($(this).val() == '') {
            $('.live-preview .price').html('0000<span> DZD</span>');
        } else {
            $('.live-preview .price').html($(this).val() + '<span> DZD</span>');
        }
    });

    $('#addNewAd').on('click', function () {
        $('#newAdMessage').removeClass('message-error');
        $('#newAdMessage').html('');
        var err = false;
        var adname = $('#ad_name').val();

        $('#ad_name').on('focus', function () {
            $('#ad_name').removeClass('error');
        });
        $('#ad_name').on('blur', function () {
            if ($('#ad_name').val() == '') {
                $('#ad_name').addClass('error');
            }
        });
        $('#ad_price').on('focus', function () {
            $('#ad_price').removeClass('error');
        });
        $('#ad_price').on('blur', function () {
            if ($('#ad_price').val() == '') {
                $('#ad_price').addClass('error');
            }
        });
        $('#ad_cat').on('focus', function () {
            $('#ad_cat').removeClass('error');
        });
        $('#ad_cat').on('blur', function () {
            if ($('#ad_cat').val() == 0) {
                $('#ad_cat').addClass('error');
            }
        });
        $('#ad_status').on('focus', function () {
            $('#ad_status').removeClass('error');
        });
        $('#ad_status').on('blur', function () {
            if ($('#ad_status').val() == 0) {
                $('#ad_status').addClass('error');
            }
        });

        if (adname.trim() == '') {
            $('#ad_name').addClass('error');
            err = true;
        }
        if ($('#ad_price').val() == '') {
            $('#ad_price').addClass('error');
            err = true;
        }
        if ($('#ad_cat').val() == '0') {
            $('#ad_cat').addClass('error');
            err = true;
        }
        if ($('#ad_status').val() == '0') {
            $('#ad_status').addClass('error');
            err = true;
        }
        if (err == true) {
            $('#newAdMessage').addClass('message-error');
            $('#newAdMessage').html('<div class="col-2"><i class="fa fa-remove"></i></div><div class="col-10"><span>Erreur</span><p>Vérifiez les champs obligatoires!</p></div>');
            $('#newAd').focus();
        } else {
            $.ajax({
                type: 'POST',
                url: 'includes/ajax/add_new_ad.php',
                data: $('#newad-form').serialize() + '&' + $('#addNewAd').attr('name') + '=' + $('#addNewAd').attr('name'),
                success: function(data){
                    if (data !== '') {
                        $('#newAdMessage').addClass('message-success');
                        $('#newAdMessage').html('<div class="col-2"><i class="fa fa-check"></i></div><div class="col-10"><span>Erreur</span><p>Article ajouté avec succès</p></div>');
                        $('#newAd').focus();
                        setTimeout('window.location.reload()',3000);
                    } else {
                        $('#newAdMessage').addClass('message-error');
                        $('#newAdMessage').html('<div class="col-2"><i class="fa fa-remove"></i></div><div class="col-10"><span>Erreur</span><p>Il y a une erreur!</p></div>');
                        $('#newAd').focus();
                    }
                },
                error: function(){
                    $('#newAdMessage').addClass('message-error');
                    $('#newAdMessage').html('<div class="col-2"><i class="fa fa-remove"></i></div><div class="col-10"><span>Erreur</span><p>Une erreur s\'est produite lors de la connexion à la base de données.<br> Veuillez réessayer plus tard.</p></div>');
                    $('#newAd').focus();
                }
            });
        }
    });

    // Ends New Article Modal

	// Hide Placeholder On Form Focus
	$('[placeholder]').focus(function () {
        //$(this).css('color', '#ddd');
	}).blur(function () {
        //$(this).css('color', '#aaa');
	});


	// Convert Password Field To Text Field On Hover
    $('.show-pass').hover(function () { 
        $(this).siblings("input").attr('type', 'text'); 
    },function () { 
        $(this).siblings("input").attr('type', 'Password'); 
    });
    
    // Check If Username Is Available Or Not In Add Members Page
    $("#username").keyup(function() {
        var uname = $(this).val();
        var userName = uname.trim();
        if (userName.length == 0)
        {
            $("#msg").html('<span class="text-danger">Nom d\'utilisateur ne doit pas être vide!</span>');
            $("#check-s").attr('class', 'form-group form-group-lg has-error has-feedback-lg');
            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $("#submit").attr("disabled", true);
        }else if (userName.length < 3) {
            $("#msg").html('<span class="text-danger">Nom d\'utilisateur ne peut pas être inférieur à <strong> 3 caractères</strong>!</span>');
            $("#check-s").attr('class', 'has-error has-feedback-lg');
            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $("#submit").attr("disabled", true);
        }else if (userName.length > 22) {
            $("#msg").html('<span class="text-danger">Nom d\'utilisateur ne peut pas être plus de <strong>22 caractères</strong>!</span>');
            $("#check-s").attr('class', 'has-error has-feedback-lg');
            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $("#submit").attr("disabled", true);
        }else {
            $.ajax({
                url: "includes/check/check_username.php",
                data: {username: uname},
                type: "POST",
                success: function(data) {
                    if(data > '0') {
                        $("#check-s").attr('class', 'form-group form-group-lg has-error has-feedback-lg');
                        $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                        $("#msg").html('<span class="text-danger">Nom d\'utilisateur déjà pris!</span>');
                        $("#submit").attr("disabled", true);
                    } else {
                        $("#check-s").attr('class', 'form-group form-group-lg has-success has-feedback-lg');
                        $("#check-ok").html('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
                        $("#msg").html('<span class="text-success">Nom d\'utilisateur disponible</span>');
                        $("#submit").attr("disabled", false);
                    }
                }
            });
        }
    });

    // Check If New Username Is Available Or Not In Edit Profile Settings Page
    $("#newUserName").keyup(function(e) {
        e.preventDefault();
        var nuname = $(this).val();
        var newUserName = nuname.trim();
        if (newUserName.length == 0)
        {
            $("#msg").html('<span class="text-danger">Nom d\'utilisateur ne doit pas être <strong>vide</strong>!</span>');
            $("#check-s").attr('class', 'has-error has-feedback-lg');
            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $("#submit").attr("disabled", "");
        }else if (newUserName.length < 3) {
            $("#msg").html('<span class="text-danger">Nom d\'utilisateur ne peut pas être inférieur à <strong> 3 caractères</strong>!</span>');
            $("#check-s").attr('class', 'has-error has-feedback-lg');
            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $("#submit").attr("disabled", "");
        }else if (newUserName.length > 22) {
            $("#msg").html('<span class="text-danger">Nom d\'utilisateur ne peut pas être plus de <strong>22 caractères</strong>!</span>');
            $("#check-s").attr('class', 'has-error has-feedback-lg');
            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $("#submit").attr("disabled", "");
        }else {
            var oldUserName = $(this).attr("old-username");
            if(newUserName.toLowerCase() == oldUserName.toLowerCase()) {
                $("#msg").html("");
                $("#check-s").attr('class', '');
                $("#check-ok").html('');
                $("#submit").attr("disabled", false);
            }else{
                $.ajax({
                    url: "includes/check/check_username.php",
                    data: {new_username: newUserName},
                    type: "POST",
                    success: function(data) {
                        if(data > '0') {
                            $("#check-s").attr('class', 'has-error has-feedback-lg');
                            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                            $("#msg").html('<span class="text-danger">Nom d\'utilisateur déjà <strong>exist</strong>!</span>');
                            $("#submit").attr("disabled", "");
                        } else {
                            $("#check-s").attr('class', 'has-success has-feedback-lg');
                            $("#check-ok").html('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
                            $("#msg").html('<span class="text-success">Nouveau nom d\'utilisateur</span>');
                            $("#submit").attr("disabled", false);
                        }
                    }
                });
            }
            
        }
    });

    // Check If Catégorie Name Is Available Or Not In Add Categorie Page
    $("#catName").keyup(function(e) {
        e.preventDefault();
        var cname = $(this).val();
        var catName = cname.trim();
        if (catName.length == 0)
        {
            $("#msg").html('<span class="text-danger">Nom de catégorie ne doit pas être vide!</span>');
            $("#check-s").attr('class', 'col-md-6 has-error has-feedback-lg');
            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $("#submit").attr("disabled", true);
        }
        else
        {
            $.ajax({
                url: "includes/check/check_catname.php",
                data: {cat_name: catName},
                type: "POST",
                success: function(data) {
                    if(data > '0') {
                        $("#check-s").attr('class', 'col-md-6 has-error has-feedback-lg');
                        $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                        $("#msg").html('<span class="text-danger">Nom de catégorie déjà exist!</span>');
                        $("#submit").attr("disabled", true);
                    } else {
                        $("#check-s").attr('class', 'col-md-6 has-success has-feedback-lg');
                        $("#check-ok").html('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
                        $("#msg").html('<span class="text-success">Nouveau nom de catégorie</span>');
                        $("#submit").attr("disabled", false);
                    }
                }
            });
        }
    });

    // Check If New Catégorie Name Is Available Or Not In Edit Categorie Page
    $("#newCatName").keyup(function(e) {
        e.preventDefault();
        var ncname = $(this).val();
        var newCatName = ncname.trim();
        if (newCatName.length == 0)
        {
            $("#msg").html('<span class="text-danger">Nom de catégorie ne doit pas être vide!</span>');
            $("#check-s").attr('class', 'col-md-10 has-error has-feedback-lg');
            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $("#submit").attr("disabled", "");
        }
        else
        {
            var oldCatName = $(this).attr("old-catname");
            if(newCatName.toLowerCase() == oldCatName.toLowerCase()) {
                $("#msg").html("");
                $("#check-s").attr('class', 'col-md-10');
                $("#check-ok").html('');
                $("#submit").attr("disabled", false);
            }else{
                $.ajax({
                    url: "includes/check/check_catname.php",
                    data: {new_cat_name: newCatName},
                    type: "POST",
                    success: function(data) {
                        if(data > '0') {
                            $("#check-s").attr('class', 'col-md-10 has-error has-feedback-lg');
                            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                            $("#msg").html('<span class="text-danger">Nom de catégorie déjà exist!</span>');
                            $("#submit").attr("disabled", "");
                        } else {
                            $("#check-s").attr('class', 'col-md-10 has-success has-feedback-lg');
                            $("#check-ok").html('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
                            $("#msg").html('<span class="text-success">Nouveau nom de catégorie</span>');
                            $("#submit").attr("disabled", false);
                        }
                    }
                });
            }
            
        }
    });
        

});