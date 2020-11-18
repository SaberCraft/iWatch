$(function () {

    'use strict';
    
	// Hide Placeholder On Form Focus
	$('[placeholder]').focus(function () {
		$(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
        $(this).css("background-color", "#ffffff");
	}).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
        $(this).css("background-color", "#fcfcfc");
	});


	// Convert Password Field To Text Field On Hover
	var passField = $('.password');
	$('.show-pass').hover(function () {

		passField.attr('type', 'text');

	}, function () {

		passField.attr('type', 'Password');

	});

	// Confirmation Message On Button
	$('.confirm').click(function () {

		return confirm('êtes-vous sûr de vouloir supprimer ce membre');

    });
    
    // Check If Username Is Available Or Not In Add Members Page
    $("#username").keyup(function(e) {
        var uname = $(this).val();
        var userName = uname.trim();
        if (userName.length == 0)
        {
            $("#msg").html('<span class="text-danger">Nom d\'utilisateur ne doit pas être vide!</span>');
            $("#check-s").attr('class', 'form-group form-group-lg has-error has-feedback-lg');
            $("#check-ok").html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $("#submit").attr("disabled", true);
        }
        else
        {
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

    // Chenge Visibility status Of Category
    //$("#visbtStat").click(function(e) {
        //e.preventDefault();
        //$.ajax({
            //url: "chenge_visbt_stat.php",
            //method: "GET",
            //success: function(chenge) {
                //if(chenge = 'On') {

                    //$("#visbtStat").attr('class', 'btn btn-warning btn-xs');
            
                //} else {

                    //$("#visbtStat").attr('class', 'btn btn-success btn-xs');
                    
                //}
            //}
        //});
    //});

    // Category View Options
    $('.cat h3').click(function(){
        $(this).parent().next().children('.details').fadeToggle(300);
    });

    $('.options .view span').click(function() {
        $(this).addClass('active').siblings().removeClass('active');

        if($(this).data('view') === 'full') {
            $('.cat .panel-body .details').fadeIn(200);
        }else {
            $('.cat .panel-body .details').fadeOut(200);            
        }

    });

    // Dashborad
    $('.toggle-latest').click(function() { 
        $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);
        if($(this).hasClass('selected')) {
            $(this).html('<i class="fa fa-plus fa-lg"></i>');
        }else {
            $(this).html('<i class="fa fa-minus fa-lg"></i>');
        }            
    });
        

});