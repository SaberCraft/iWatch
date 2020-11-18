<?php
ob_start();
$pageTitle = 'Shopping cart';
include 'init.php';
?>
<div id="cart-list" class="container-fluid">
    
</div>
<?php

include $tpl . 'footer.php';
ob_end_flush();
?>
<script>
$(document).ready(function() {

    $(document).on('blur', '.IC_qty', function() {
        var itemId = $(this).attr('id').split("_").pop();
        var action = 'get_qty';
        $.ajax({
            url:"includes/ajax/cart_actions.php",
            data: {item_id:itemId, action:action},
            method:"POST",
            success:function(data) {
                $('#IC_qty_'+itemId+'').val(data);
            }
        });
    });

    $(document).on('click', '#empty_cart', function() {
        $("body").addClass('confirmation');
        bootbox.confirm({
            message: "Vous voulez vraiment jeter votre panier?",
            buttons: {
                confirm: {
                    label: 'Oui',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'Non',
                    className: 'btn-secondary'
                }
            },
            callback: function (result) {
                if(result == true) {
                    var empty_cart = 'empty_cart';
                    $.ajax({
                        url:"includes/ajax/cart_actions.php",
                        data: {empty_cart:empty_cart},
                        method:"POST",
                        success:function() {
                            $('.cart-count').text("");
                            load_cart_list();
                        }
                    });
                }
            }
        });   
    });

    load_cart_list();

});

    function RFC(event, id) {
        $("body").addClass('confirmation');
        bootbox.confirm({
            message: "Vous voulez vraiment retrier cette article de votre panier?",
            buttons: {
                confirm: {
                    label: 'Oui',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'Non',
                    className: 'btn-secondary'
                }
            },
            callback: function (result) {
                if(result == true) {
                    var itemId = id;
                    var action = 'remove';
                    $.ajax({
                        url:"includes/ajax/cart_actions.php",
                        method:"POST",
                        data: {
                            item_id:itemId,
                            action:action
                        },
                        dataType:"JSON", 
                        success:function(raport) {
                            if(raport.status == 'success') {
                                if(raport.data > 0) {
                                    $('.cart-count').text(raport.data);
                                    $('#IC_row_'+itemId+'').fadeOut();
                                    $('#CTP').text(raport.total_price);
                                } else {
                                    $('.cart-count').text("");
                                    load_cart_list();
                                }
                            } else {
                                if(confirm('You Must Login First')) {
                                    window.location = 'login.php';
                                }
                            }
                        }
                    });
                }
            }
        });
    }

    function CQOIC(qty, id) {
        var quantity = qty;
        if(quantity != "" && !isNaN(quantity) && quantity > 0) { 
            var itemId = id;  
            var action = 'quantity_change';
            $.ajax({
                url:"includes/ajax/cart_actions.php",
                method:"POST",
                data: {
                    item_id:itemId,
                    quantity:quantity,
                    action:action
                },
                dataType:"JSON",
                success:function(data) {
                    if(data.status == 'success') {
                        $('#ICTP_'+itemId+'').text(data.item_price);
                        $('#CTP').text(data.total_price);
                    }
                   
                }
            });
        }
    }
    function load_cart_list() {
        $('#cart-list').html('<span><img src="layout/images/loader.gif" class="loader" /></span>');
        var load_cart = 'load_cart';
        $.ajax({
            url:"includes/ajax/fetch_cart_list.php",
            data: {load_cart:load_cart},
            method:"GET",
            success:function(data){
                $('#cart-list').html(data);  
            }
        });
    }

</script>