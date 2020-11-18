 <!DOCTYPE html>
 <html>
 <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.css">
    <link rel="stylesheet" href="<?php echo $css; ?>style.css">
	
	<title><?php getTitle() ?></title>
    
<style>
/* start main rules */

body {
    padding: 0;
    margin: 0;
    background-color: #F4F4F4;
    color: #343A40;
    overflow-x: hidden;
    font-family: Arial, sans-serif;
    font-size: 16px;
    line-height: 20px;
}
body.confirmation .modal-dialog {
    top: 20%;
}
.footer {
    width: 100%;
    background-color: #c3c3c3;
    color: #464646;
    height: 150px;
    margin-top: 20px;
}
.footer ul {
    padding-top: 26px;
    padding-left: 60px;
}
input, select, textarea {
    border-radius: 2px;
    font-size: 17px;
    display: block;
    width: 100%;
    color: #495057;
    background-image: none;
    background-clip: padding-box;
    font-weight: 300;
    padding: 12px 15px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    background: #fdfdfd;
    border: 1px solid #d9d9d9;
    border-top: 1px solid #c0c0c0;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}
input[type="radio"] {
    height: 12px;
    width: 12px;
}
button.btn, a.btn, input[type="submit"] {
    border-radius: 2px;
}
.fa-asterisk {
	position: relative;
    bottom: 5px;
    font-size: 50%;
    color: #c70000;
}
.items .mark-name {
    text-align: center;
	padding: 20px;
    margin-top: 15px;
    background: radial-gradient(#ffffff 10%, #989595);
    border: 2px solid #989595;
}
.items .mark-name img {
    margin: 10px;
    width: 200px;
    height: 50px;
}
.loader {
    width: 60px;
    margin-left: 47%;
    margin-bottom: 10px;
}
/* Ends main Rules */

/* Ends Contact us Page */

#contact-us {
    width: 40%;
    height: 92%;
    background: #E2E2E2;
    margin: 5% 29%;
    padding: 2%;
    border-radius: 2px;
    box-shadow: 1px 1px 3px rgba(0,0,0,0.2);
    display: block;
    margin-top: 2em;
}
#contact-us h1 {
    text-align: center;
    margin-top: 5px;
}

#contact-us p {
    text-align: center;
    margin-bottom: 1em;
}

#contact-us .feild {
    width: 90%;
    margin-left: 5%;
    margin-right: 5%;
    margin-top: 10px;
}

#contact-us [type="submit"] {
    border: 1px solid #2f5bb7;
    color: #fff;
    padding: 10px;
    text-shadow: 0 1px rgba(0,0,0,0.3);
    background-color: #357ae8;
    background-image: -webkit-linear-gradient(top,#4d90fe,#357ae8);
    margin-top: 12px;
    font-weight: 500;
}

#contact-us [type="submit"]:hover {
    border-color: #c6c6c6;
    color: #fff;
    cursor: pointer;
    -o-transition: all 0.2s;
    -moz-transition: all 0.3s;
    -webkit-transition: all 0.2s;
    transition: all 0.2s;
    background-color: #4c8ffc;
    background-image: -webkit-linear-gradient(top,#4c8ffc,#4889f0);
    background-image: -moz-linear-gradient(top,#4c8ffc,#4889f0);
    background-image: -ms-linear-gradient(top,#4c8ffc,#4889f0);
    background-image: -o-linear-gradient(top,#4c8ffc,#4889f0);
    background-image: linear-gradient(top,#4c8ffc,#4889f0);
    -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
  }

#contact-us .checkbox {
    padding: 8px;
    margin-top: 8px;
}
.checkbox input .human_veryfication {
    float: left;
    margin-left: -60px;
    margin-top: 5px;
}
.checkbox label {
    margin-left: 4%;
}

@media only screen and (max-width: 500px) {
	#contact-us form {
		left: 3%;
		margin-right: 0%;
		width: 100%;
		margin-left: 0%;
		padding-left: 3%;
		padding-right: 3%;
	}
}
/* Ends Contact us Page */

/* Start Social Media bottons */
.social-media .fa {
    padding: 8px;
    font-size: 14px;
    width: 30px;
    text-align: center;
    text-decoration: none;
    margin: 5px 2px;
    border-radius: 50%;
}

.social-media .fa:hover {
    opacity: 0.7;
}

.social-media .fa-facebook {
    background: #3B5998;
    color: white;
}

.social-media .fa-twitter {
    background: #55ACEE;
    color: white;
}

.social-media .fa-google {
    background: #dd4b39;
    color: white;
}
.social-media .fa-linkedin {
    background: #007bb5;
    color: white;
}

.social-media .fa-youtube {
    background: #bb0000;
    color: white;
}

.social-media .fa-instagram {
    background: #125688;
    color: white;
}

.social-media .fa-pinterest {
    background: #cb2027;
    color: white;
}

.social-media .fa-snapchat-ghost {
  background: #fffc00;
  color: white;
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
/* Ends Social Media bottons */

/* Start Index & Hashtag Pages */
.card-deck-head {
    text-align: center;
    margin-top: 15px;
}
.head-primary {
    color: #fff;
    background: #4c88bc;
}
.head-pink {
    color: #fff;
    background: #E6D6B9;
}
.head-secondary {
    color: #fff;
    background: #989595;
}
.card-deck-head .card-deck-head-text {
    margin: 0;
    padding: 5px;
}
.card-deck-head .card-deck-head-text a {
    color: #0a4b92;
    /* text-decoration: none; */
}
/* Start Index Page */

/* Start Mail-carousel */
.carousel-row {
    margin-right: -30px;
    margin-left: -30px;
}
#main-carousel {
    z-index: 120;
}
#main-carousel .carousel-inner {
    height: 500px;
}
#main-carousel .carousel-inner .carousel-item {
    height: 100%;
}
/* Ends Mail-carousel */

/* Start Cart Page */
#cart-list .loader {
    margin-top: 10px;
    margin-bottom: 0px;
}
#cart-list .cart-title {
    margin: 10px auto;
}
#cart-list .table {
    width: 96%;
    max-width: 96%;
    margin-left: 2%;
    background-color: #fff;
}
#cart-list .table img {
    width: 100%;
}
#cart-list .table .item-title {
    font-size: 1.4rem;
    color: #007bff;
}
#cart-list .table .rfc {
    margin: 30px;
    font-size: 18px;
    padding: 0px 6px;
    border-radius: 1rem;
    cursor: pointer;
}
#cart-list .table .place-order {
    width: 20%;
}
#empty-cart {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    margin: 0 auto;
}
#empty-cart img {

}
#empty-cart .alert {
    margin-left: 60px;
    text-align: center;
    border-color: #b3953f;
}
#empty-cart .alert a {
    display: block;
}
/* Start Cart Page */

/* Start Item Page */

.item-details .item-galery #main-img {
    width: 540px;
    height: 319px;
}
.item-details .item-galery .sec-img img {
    width: 113px;
    height: 90px;
    cursor: pointer;
}
.item-details .item-galery .active {
    box-shadow: 0 0 6px 1px rgba(33,153,232,.5);
}
.item-details p {
    height: 68px;
    overflow: auto;
    margin-bottom: 10px;
}
.item-details .item-price {
    font-size: 19px;
    font-weight: bold;
    margin-bottom: 10px;
    margin-right: 10px;
}
.item-details .info {
    font-size: 18px;
    font-weight: bold;
}
.item-details .info span {
    font-size: 17px;
    font-weight: normal;
}
.item-details .info .item-tag {
    margin-right: 8px;
    text-decoration: none;
}
.lcs {
    width: 100%;
    margin: 0;
}
.lcs .inf {
    margin-left: 8%;
}
.lcs a {
    margin-left: 21%;
}
.tab-content {
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-top: none;
}
/* Ends Item Page */

/* Start Cart Dropdown */
#cart-dropdown .badge {
    position: absolute;
    top: 1px;
    left: 22px;
    padding: 0.2em 0.27em;
    font-size: 72%;
    font-weight: normal;
    color: #fff;
    background-color: #F18E00;
}
.cart-menu {
    padding: 0;
    right: -10px;
    left: auto;
    top: 41px;
}
.shopping-cart-dropdown-header {
    padding: 0.5rem;
    font-size: 14px;
    border-bottom: 1px solid #e6e6e6;
    background-color: #EEEEEE;
}
.shopping-cart-dropdown-header p {
    display: inline;
    padding: 0;
    margin-bottom: 0px;
}
.shopping-cart-dropdown-header .shopping-cart-total {
    float: right;
    font-weight: none;
}
.shopping-cart-dropdown-pane {
    min-width: 16rem;
}
.shopping-cart-dropdown-pane .dropdown-pane {
    padding: 0;
    max-height: 376px;
    overflow-y: auto;
}
.dropdown-pane .alert {
    margin: 0;
    padding: 0.75rem 3rem;
}
.shopping-cart-item {
    position: relative;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e6e6e6;
}
.shopping-cart-item:hover {
    background-color: #f9f9f9;
}
.shopping-cart-item .img-shopping-cart {
    width: 80px;
    height: 80px;
}
.shopping-cart-item-name {
    padding: 0 0.5rem;
    width: 220px;
}
.price {
    color: #17a2b8;
    font-weight: lighter;
}
.remove {
    position: absolute;
    top: 47px;
    right: 14px;
    color: #e6848e;
}
.remove:hover {
    color: #dc3545;
}
.shopping-cart-item-name .item-name {
    padding: 0;
    color: #007bff;
    font-size: 18px;
}
.shopping-cart-item-name .quantity {
    font-size: 14px;
}
.shopping-cart-item-name p {
    margin: 0;
    padding: 0;
}
.shopping-cart-title {
    color: #343A40;
    font-weight: bold;
}
.cart-item-info p {
    font-size: 15px;
}
.shopping-cart-dropdown-footer {
    padding: 0.25rem;
    text-align: center;
    margin-bottom: 0;
    border-top: 1px solid #e6e6e6;
    background-color: #f9f9f9;
}
.shopping-cart-dropdown-footer .shopping-cart-view-all {
    padding: 0;
    color: #4986C8;
    font-size: 14px;
    font-weight: bold;
}
/* Ends Cart Dropdown */

/* Start notifications Dropdown */

.notifs-menu {
    padding: 0;
    right: -10px;
    left: auto;
    top: 42px;
}
.notifs-count {
    position: absolute;
    top: 1px;
    left: 22px;
    padding: 0.2em 0.27em;
    font-size: 72%;
    font-weight: normal;
    color: #fff;
    background-color: #dc3545;
}
.triangle-up-notifs {
    position: absolute;
    display: block;
    z-index: 1030;
    top: -11px;
    right: 17px;
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-bottom: 11px solid #f9f9f9;
}

/* Ends notifications Dropdown */
/* Start Comments */
.item-comments {
    padding-top: 20px;
    padding-bottom: 1px;
    background-color: #F4F4F4;
}
.item-comments .comment-form {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}
.item-comments .replay-comment-form {
    margin-left: 80px;
    margin-top: 10px;
}
.item-comments .comment_form {
    width: 100%;
    height: auto;
    margin-right: 1rem;
}
.item-comments .comment_content {
    margin-top: 3px;
    margin-left: .5rem;
    border-radius: 20px;
}
.item-comments .comment-form .img-cf {
    border-radius: 50%;
    width: 45px;
    height: 45px;
}
.item-comments .comment-form .img-rcf {
    border-radius: 50%;
    width: 35px;
    height: 35px;
}
.item-comments .error {
    color: #dc3545!important;
    margin-left: 70px;
    margin-top: -5px;
}
.item-comments #display_item_comment {
    padding: 10px;
}
.comment-section-container {
    padding-bottom: 10px;
    padding-top: 10px;
}
.comment-section-author {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: flex-start;
    -ms-flex-align: flex-start;
    align-items: flex-start;
}
.comment-section-author .avatar {
    border-radius: 50%;
    width: 45px;
    height: 45px;
}
.comment-section-author .reply-avatar {
    border-radius: 50%;
    margin-top: 5px;
    width: 35px;
    height: 35px;
}
.comment-section-author .comment-section-name {
    margin-left: .5rem;
    background-color: #fff;
    padding: 10px 14px;
    border-radius: 26px;
}
.comment-section-author .comment-section-name .comment-author {
    margin: 0;
    font-weight: bold;
    letter-spacing: 0.4px;
}
.comment-section-author .comment-section-name p {
    margin-bottom: 0;
}
.comment-author a:hover {
    color: #006fe6;
}
.cmt-options {
    margin-left: 10px;
}
.cmt-options .dropdown-menu {
    min-width: 0;
    padding: 0.2rem 0;
    font-size: 0.8rem;
    padding: 4px 0px;
}
.cmt-options .dropdown-menu .dropdown-item {
    padding: 4px 8px;
}
.comment-section-option {
    margin-left: 4.2rem;
    font-size: 14px;
}
.reply-cso {
    margin-left: 4.2rem;
}
.comment-section-option .comment-time abbr {
    text-decoration: none;
    cursor: default;
}
.comment-section-option a {
    color: #347aff;
    cursor: pointer;
}

/* Ends Comments */

/* Start Search */
#searchForm {
    display: flex;
    margin-top: 20px;
}
#searchForm input,select {
    padding: 10px 12px;
}
#searchForm button {
    width: 9%;
    border-radius: 0 2px 2px 0;
    border: none;
    color: #fff;
    cursor: pointer;
    font-size: 19px;
    -o-transition: all 0.2s;
    -moz-transition: all 0.3s;
    -webkit-transition: all 0.2s;
    transition: all 0.2s;
    background-color: #A8AEB3;
    background-image: -webkit-linear-gradient(top,#bfd0e8,#47618a);
    background-image: -moz-linear-gradient(top,#bfd0e8,#47618a);
    background-image: -ms-linear-gradient(top,#bfd0e8,#47618a);
    background-image: -o-linear-gradient(top,#bfd0e8,#47618a);
    background-image: linear-gradient(top,#bfd0e8,#47618a);
    -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
/* Ends Search */

/* Start Bootstrap Edits */
.navbar {
	height: 55px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    width: 100%;
}
.bg-light {
    background-color: #e2e2e2!important;
}
.navbar-light .navbar-brand {
    line-height: 40px;
    font-size: 25px;
}
.navbar-nav {
    padding-top: 5px;
}
.navbar-nav-right{
    margin-left: auto!important;
}
.navbar-nav-right li {
    margin-left: 1.5rem;
}
.navbar-nav-left {
    margin-right: 0rem;
}
.navbar-nav .nav-link {
	font-size: 18px;
}
.navbar-nav i {
	font-size: 21px;
}
.share-dropdown .dropdown-menu {
    left: 10px;
	padding: 5px 10px;
    min-width: 8rem;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}
.hover-dropdown .dropdown-menu {
	top: 52px;
	background-color: #E2E2E2;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    animation-name: zoom;
    animation-duration: 0.4s;
    animation-delay: -0.2s;
}
@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}
.dropdown-item {
    padding: 8px 20px;
}
.hover-dropdown:hover .dropdown-menu {
    display: block;
}
.hover-dropdown:hover .dropbtn {
    color: #464646;
}
.hover-dropdown form.dropdown-menu {
    display: none;
	position: absolute;
	top: 37px;
    left: -46px;
	background-color: #E2E2E2;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	z-index: 1040;
    animation-name: zoom;
    animation-duration: 0.2s;
    animation-delay: -0.1s;
}
.hover-dropdown:hover .dropbtnform {
    color: #0968ce;
}
.hover-dropdown .dropdown-item {
    color: #343A40;
}
.hover-dropdown .dropdown-item:active {
    background-color: #343A40;
    color: #fff;
}
.triangle-up {
    position: absolute;
    display: none;
    opacity: 0;
    z-index: 1030;
    width: 0;
    height: 0;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    animation-name: zoom;
    animation-duration: 0.4s;
    animation-delay: -0.2s;
}
.logform {
    width: 84px;
    height: 13px;
    top: -13px;
    right: 82px;
    border-bottom: 11px solid #E2E2E2;
}
.marks {
    width: 56px;
    top: 45px;
    left: 230px;
    border-bottom: 11px solid #343A40;
}
.user {
    top: 45px;
    right: 24.6px;
    border-bottom: 11px solid #343A40;
}
.hover-dropdown:hover .triangle-up {
    display: block;
    opacity: 1;
}
.form-control-feedback {
	position: absolute;
    top: 6px;
    right: 14px;
}

/* Ends Bootstrap Edits */

/* Start TagsInput */
.bootstrap-tagsinput {
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    display: block;
    vertical-align: middle;
    width: 100%;
    cursor: text;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-image: none;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}
.bootstrap-tagsinput input {
    border: none;
    box-shadow: none;
    outline: none;
    background-color: transparent;
    padding: 0 6px;
    margin: 0;
    width: auto;
    max-width: inherit;
}
.bootstrap-tagsinput.form-control input::-moz-placeholder {
    color: #777;
    opacity: 1;
}
.bootstrap-tagsinput.form-control input:-ms-input-placeholder {
    color: #777;
}
.bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
    color: #777;
}
.bootstrap-tagsinput input:focus {
    border: none;
    box-shadow: none;
}
.bootstrap-tagsinput .tag {
    display: inline-block;
    padding: 0.25em 0.3em 0.25em 0.4em;
    font-size: 90%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 5px;
    border: 1px solid #3c8ecc;
    color: #146aab;
    background-color: #ddebf7;
    margin-right: 2px;
    margin-bottom: 4px;
}
.bootstrap-tagsinput .tag [data-role="remove"] {
    margin-left: 2px;
    color: #6b91cc;
    border-radius: 5px;
    cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
    content: "x";
    padding: 0px 3px;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
    color: #146aab;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
    box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
/* Ends TagsInput */

/* Start Items Card */
.card-deck {
    min-height: 355px;
    padding-top: 20px;
    margin-right: 0px;
    margin-left: 0px;
    background-color: #fdfdfd;
}
.pink-cd {
    border: 2px solid #E6D6B9;
    border-top: none;
}
.primary-cd {
    border: 2px solid #4c88bc;
    border-top: none;
}
.secondary-cd {
    border: 2px solid #989595;
    border-top: none;
}
.card-deck .alert {
    height: 52px;
    display: inherit;
    width: 100%;
    margin-left: 15px;
    margin-right: 15px;
}
.card-deck .card {
    margin: 0;
    margin-top: 5px;
	margin-bottom: 20px;
    box-shadow: rgba(0, 0, 0, 0.2) 0 2px 6px 0;
}
.card-deck .card:hover {
    box-shadow: rgba(0, 0, 0, 0.2) 0 6px 12px 0; 
}
.card .new {
    position: absolute;
    top: -1px;
    right: -2px;
    width: 70px;
    height: 70px;
}
.card-body {
    text-align: center;
    padding: 10px;
}
.card-body a {
    text-decoration: none;
}
.card-body .card-title {
    color: #0273D5;
    font-size: 17px;
    /* font-weight: bold; */    
}
.card-body .card-title:hover {
    color: #1463B9;
}
.card-body .rating {
    font-size: 14px;
}
.card-footer {
	padding: 2px 0px;
	text-align: center;
	background-color: #fafafa;
}
.checked {
    color: orange;
}
.card .price {
    position: absolute;
    background-color: #fff;
    padding: 0px;
    font-size: 15px;
    font-weight: bold;
    top: 0px;
    left: 5%;
    z-index: 1;
}
.card .item-status {
    position: absolute;
    font-size: 24px;
    color: #ff8d00;
    bottom: 3px;
    right: 6px;
}
@keyframes fadeIn { 
  from { opacity: 0; } 
}
@-o-keyframes fadeIn { 
  from { opacity: 0; } 
}
@-moz-keyframes fadeIn { 
  from { opacity: 0; } 
}
@-webkit-keyframes fadeIn { 
  from { opacity: 0; } 
}
.animate-flicker {
    -o-animation: fadeIn .5s infinite alternate;
    -moz-animation: fadeIn .5s infinite alternate;
    -webkit-animation: fadeIn .5s infinite alternate;
    animation: fadeIn .5s infinite alternate;
}
.card .price span {
	font-size: 12px;
    color: #737373;
}
.card img {
    width: 92%;
    position: relative;
    left: 4%;
    top: -10px;
    box-shadow: rgba(0, 0, 0, 0.2) 0 6px 16px 0;
}
.card-btns a {
    font-size: 22px;
    color: #868e96;
    text-decoration: none;
    padding: 4px 10px;
    cursor: pointer;
}
.card-btns a i.fa-eye:hover {
    color: #17a2b8;
}
.card-btns a i.fa-cart-plus:hover {
    color: #dc3545;
}
.card-btns a i.fa-check {
    color: #dc3545;
}
a.add_to_cart {
    color: #fff;
    background-color: #F18E00;
}
a.add_to_cart:hover {
    background-color: #da8c1c;
}

/* Ends Items Card */

/* Start upper-bar */
.upper-bar {
	padding: 0;
	color: #fff;
	background-color: #a8aeb3;
}
.upper-bar .welcome {
    float: right;
    position: relative;
    top: 10px;
}
.upper-bar .reg {
    float: right;
    position: relative;
    top: 3px;
}
.upper-bar .signup {
	float: right;
    padding: 10px;
    color: #fff;
    font-size: 15px;
    font-weight: bold;
}
.upper-bar .signup a {
	color: #fff;
	text-decoration: none;
}
.upper-bar .signup a.logg:hover {
	color: #0968ce;
}
.upper-bar .signup a.siggn:hover {
	color: green;
}
.upper-bar small {
	position: relative;
	top: -6px;
    right: 1px;
    font-size: 12px;
	color: #710b0b;
}
.upper-bar #lang {
    margin-top: 10px;
}
.upper-bar #lang .lang {
    color: #104882;
    cursor: pointer
}
/* Ends upper-bar */

/* login/signup */
.login-page h1 {
	font-size: 40px;
    font-weight: bold;
    margin: 25px 0px;
    margin-top: 70px;
}
.login-page form {
	max-width: 368px;
	margin: auto;
	margin-top: 20px;
}
.login-page form label {
	font-size: 16px;
}
.login-page form .show-pass  {
	position: relative;
	font-size: 1.5em;
	bottom: 32px;
    right: -333px;
}
.login-page h1 {
	color: #c0c0c0;
}
.login-page h1 span {
	cursor: pointer;
}
.sign {
	color: #28A745;
}
.log {
	color: #007BFF;
}
.login-page .login {
	display: none;
}
#msg span {
    font-size: 14px;
}
.errors {
    padding: 10px 15px;
    margin-bottom: 15px;
    background-color: #ffebeb;
    border: 1px solid #dc3545;
}
.success {
    padding: 10px 15px;
    margin-bottom: 15px;
    background-color: #e2ffe9;
    border: 1px solid #28a745;
}
/* login/signup Ends */

/* Start profile-links Edits */
.settigs-side-links {
    padding-top: 10px;
    background-color: #ffffff;
	border: 2px solid #343A40;
	border-right: none;
}
.settigs-side-links img {
    margin-top: 10px;
    width: 135px;
    height: 135px;
}
.settigs-side-links hr {
    border-color: #343A40;
}
.settigs-links {
    margin: 0;
}
.settigs-links .active a {
    background-color: #343A40;
    color: #fff;
}
.settigs-links ul {
	list-style-type: none;
    padding: 0;
}
.settigs-links ul li {
    margin: 0;
}
.settigs-links ul li a {
    display: block;
    text-decoration: none;
    padding: 5px;
    color: #343A40;
    font-size: 15px;
}
.settigs-links ul li:not(.active) a:hover {
	background-color: #dedede;
}
.settigs-header {
    text-align: center;
    background-color: #ffffff;
    border: 2px solid #343A40;
}
.settigs-header h2 {
	margin-top: 10px;
}
.settigs-header p {
    font-size: 16px;
}
.settigs-body {
    padding-top: 15px;
    background-color: #ffffff;
	border: 2px solid #343A40;
	border-top: none;
}
.settigs-body label {
font-size: 16px;
}
/* Ends profile-links Edits */

/* Start Filtration */
.filtration {
    position: sticky;
    top: 70px;
    background-color: #ffffff;
    padding-bottom: 1px;
    margin-top: 15px;
    margin-bottom: 15px;
    color: #343A40;
}
.hide {
    display: none;
}
.filtration h1 {
    padding: 15px 20px 20px;
}
.filter-name{
    background-color: #fff;
    padding: 8px 10px;
    margin-bottom: 2px;
}
/* Ends Filtration */

/* Strat Price Slider */
.filter-option {
	width: 100%;
	text-align: center;
	padding: 0px 10px;
	margin-bottom: 20px;
}
.price-slider {
    -webkit-appearance: none;
    width: 100%;
    height: 0px;
    padding: 4px 0;
    margin-bottom: 3px;
    border-radius: 5px;
    background: #8a8a8a;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}
.price-slider:hover {
    opacity: 1;
}
.price-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #0056a0;
    cursor: pointer;
}
.price-slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}
/* Ends Price Slider */

/* Ends Filtration */

/* Start Image View 

#myImg {
	border-radius: 5px;
    cursor: pointer;
	transition: 0.3s;
	width:100%
}
/* The Modal (background) */
/*
.modal {
    display: none; /* Hidden by default */
    /*position: fixed; /* Stay in place */
    /*z-index: 2000; /* Sit on top */
    /*padding-top: 100px; /* Location of the box */
    /*left: 0;
    top: 0;
    width: 100%; /* Full width */
    /*height: 100%; /* Full height */
    /*overflow: auto; /* Enable scroll if needed */
    /*background-color: rgb(0,0,0); /* Fallback color */
    /*background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
/*}

/* Modal Content (image) */
/*
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
/*
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
/*
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
/*
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
/*
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
/* Ends Image View */

/* Start Profile Page */

/* Start Profile User Card */

.user-card {
    background-color: #fff;
    margin-top: 15px;
    margin-right: -15px;
    padding: 20px 7.5px;
}
.user-card img {
    height: 120px;
    width: 120px;
}
.user-card .user-info {
    margin-bottom: 0.5rem;
}
.user-info span {
    display: block;
}
.trust {
    position: absolute;
    top: 43px;
    left: 65px;
    font-size: 22px;
    color: #2d8ce8;
    z-index: 1;
}
/* Ends Profile User Card */

/* Start User Items */
.user-items .items-head {
    position: relative;
    margin-top: 15px;
    padding: 5px;
    background-color: #e6d6b9;
}
.items-head .title {
    font-size: 22px;
    padding-left: 15px;
    position: relative;
    top: 2px;
}
.items-head .item-settigs {
    float: right;
    padding-top: 2.5px; 
}
.items-head .item-settigs .itemsbtn {
    padding: 4px 10px;
    color: #969696;
}
.item-settigs .user-items-tri {
    right: 9.5px;
    top: 28px;
    border-bottom: 11px solid #E2E2E2;
}
.item-settigs .dropdown-menu {
    right: 5px;
    top: 36px;
    left: auto;
    background-color: #e2e2e2;
}
.hover-dropdown:hover .itemsbtn {
    color: #343A40;
}
#closeFilter {
    position: absolute;
    right: 8px;
    top: 5px;
    cursor: pointer;
    color: #a2a2a2;
}
#closeFilter:hover {
    color: #343A40;
}
.message-error {
    margin: 0 auto;
    max-width: 450px;
    border-radius: 5px;
    padding: 10px 20px;
    margin-bottom: 20px;
    border: 4px solid;
    color: #dc3545 !important;
}
.message-success {
    margin: 0 auto;
    max-width: 450px;
    border-radius: 5px;
    padding: 10px 20px;
    margin-bottom: 10px;
    border: 4px solid;
    color: #28a745 !important;
}
#newAdMessage .col-2 {
    margin-right: -15px;
}
#newAdMessage .fa {
    font-size: 33px;
    position: relative;
    top: 9px;
    left: -16px;
}
#newAdMessage span {
    font-weight: bold;
    font-size: 19px;
}
#newAdMessage p {
    margin-bottom: 0px;
    color: #8c8c8c;
}
form .error {
	background-color: #F2DEDE;
}
/* Ends User Items */

/* Start Contact */
.contact {
    background-color: #fff;
    padding: 15px;
}
/* Ends Profile Page */
</style>
 </head>
  <body <?php if($_SESSION['lang'] == 'ar') { echo 'dir="rtl"'; } ?>>
	<div class="container-fluid">
  		<div class="row upper-bar">
			<div class="col-7 social-media">
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-google"></a>
                <a href="#" class="fa fa-youtube"></a>
            </div>
            <div class="col-1">
                <a href="aide.php"><?php echo translate("help") ?></a>
            </div>
            <div id="lang" class="col-2">
                <?php echo translate("language") ?>:
                <?php
                if ($_SESSION['lang'] == "ar")
                    echo '<span class="lang" data-lang="fr">'.translate("french").'</span>';
                else
                    echo '<span class="lang" data-lang="ar">'.translate("arabic").'</span>';
                ?>
            </div>
			<div class="col-2">
				<?php
                if(isset($userId)){
                    echo '<span class="welcome">'.translate("welcome").' '.$_SESSION['user'].'</span>';
                }else{
				?>
				<span class="signup">
					<span class="hover-dropdown show">
						<a class="logg dropbtnform" href="#" role="button" id="dropdownForm" aria-haspopup="true" aria-expanded="false"><?php echo translate("login") ?></a>
						<form action="login.php" method="POST" class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="dropdownForm" role="menu">
                            <div class="triangle-up logform"></div>
							<div class="form-group">
                                <label for="user">Nom d'utilisateur:</label>
                                <input type="text" class="form-control" id="user" name="username" placeholder="Nom d'utilisateur" autofocus>
							</div>
							<div class="form-group">
                                <label for="password">Mot de passe:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
							</div>
							<div class="form-check">
							    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" />
                                    Souvenir moi
							    </label>
							</div>
							<input type="submit" name="login" class="btn btn-primary btn-block" value="Se connecter">
						</form>
					</span> /
					<a class="siggn" href="login.php" ><?php echo translate("signup") ?></a>
				</span>
				<?php } ?>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-sm navbar-light bg-light indigo sticky-top scrolling-navbar">
        <a class="navbar-brand mb-0 h1" href="index.php">iWatch</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav navbar-nav-left">
        <li class="nav-item active">
            <a class="nav-link" href="index.php"><i class="fa fa-home"></i> <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><?php echo translate('purchase') ?></a>
        </li>
        <!-- Dropdown -->
        <li class="nav-item hover-dropdown">
            <a class="nav-link dropbtn" href="#" id="navbarDropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo translate('marks') ?>
            </a>
            <div class="triangle-up marks"></div>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" role="menu" style="left: 213px;">
            <?php
                foreach (getCats() as $cat) {
                    echo '<a class="dropdown-item" href="mark.php?markId='.$cat['cat_id'].'">'.$cat['cat_name'].'</a>';
                }
            ?>
            </div>
        </li>
        <!-- Dropdown -->
        <li class="nav-item">
            <a class="nav-link" href="contact-us.php"><?php echo translate('contact-us') ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cart.php"><?php echo translate('cart') ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" 
               href="#search" 
               data-toggle="collapse" 
               role="button" 
               aria-expanded="false" 
               aria-controls="search" 
               title="<?php echo translate('search..') ?>">
                <i class="fa fa-search"></i>
            </a>
        </li>
    </ul>
	
	<?php
	if(isset($userId)) { ?>
		<ul class="navbar-nav navbar-nav-right">
            
            <!-- Start Wishlists Dropdown -->
            <li class="nav-item my-2 my-lg-0">

                <div id="notifs-list" class="dropdown">
                    <a href="#" class="nav-link" role="button" id="notifs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge notifs-count">0</span>
                        <i class="fa fa-heart-o"></i>
                    </a>

                    <div class="dropdown-menu notifs-menu" aria-labelledby="notifs">
                        <div class="triangle-up-notifs"></div>
                    </div>
                        
                </div>

            </li>
            <!-- Ends Wishlists Dropdown -->

            <!-- Start Cart Dropdown -->
            <li class="nav-item my-2 my-lg-0">

            <div id="cart-dropdown" class="dropdown">
                <a href="#"class="nav-link" role="button" id="cart-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="badge cart-count"><?php if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]) > 0) { echo count($_SESSION["shopping_cart"]); } ?></span>
                </a>

                <div class="dropdown-menu cart-menu" aria-labelledby="cart-btn">
                    <div class="triangle-up-notifs"></div>
                    <div class="shopping-cart-dropdown-pane">

                        <div class="shopping-cart-dropdown-header">
                            <p class="shopping-cart-title">Liste de panier (<span class="cart-count"><?php if(isset($_SESSION["shopping_cart"])) { echo count($_SESSION["shopping_cart"]); }else{ echo '0'; } ?></span>)</p>

                            <div class="shopping-cart-total">
                                <span class="text-muted">Total:</span>
                                <p class="price">
                                <span class="total-price">
                                <?php 
                                $total = 0;
                                if(isset($_SESSION["shopping_cart"])) {    
                                    foreach($_SESSION["shopping_cart"] as $keys => $values) { 
                                        $total = $total + $values["item_quantity"] * $values["item_price"];  
                                    }    
                                    echo number_format($total, 2);        
                                }else{
                                    echo '0.00';
                                }
                                ?>
                                </span> DZD</p>
                            </div>
                        </div>

                        <div class="dropdown-pane">
                        <?php
                        $cart_content = '';
                        if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]) > 0) {    
                            foreach($_SESSION["shopping_cart"] as $keys => $values) {  
                                $cart_content .= '  
                                    <div class="shopping-cart-item">
                                        <img class="img-shopping-cart" src="data/uploads/images/items/'.$values["item_image"].'">
                                        <div class="shopping-cart-item-name">
                                            <a href="cart.php#IC_row_'.$values["item_id"].'" class="item-name">'.$values["item_name"].'</a>
                                            <div class="cart-item-info">
                                                <p class="shopping-cart-title">Prix: <span class="price">'.number_format($values["item_price"], 2).' DZD</span></p>
                                                <p class="quantity text-muted">Quantité: '.$values["item_quantity"].'</p>
                                            </div>
                                        </div>
                                        <a href="#" class="remove remove_item_cart" id="IC'.$values["item_id"].'" role="button"><i class="fa fa-close"></i></a>
                                    </div>
                                ';  
                            }   
                            echo $cart_content;         
                        }else{
                            echo '<div class="alert alert-warning">Votre panier est vide.</div>';
                        } 
                        ?>
                        </div>

                        <div class="shopping-cart-dropdown-footer">
                            <a href="cart.php" class="shopping-cart-view-all">Accéder au panier</a>
                        </div>

                    </div>
                </div>

            </div>

            </li>
            <!-- Ends Cart Dropdown -->
            
            <!-- Start Notifications Dropdown -->
            <li class="nav-item my-2 my-lg-0">

                <div id="notifs-list" class="dropdown">
                    <a href="#" class="nav-link" role="button" id="notifs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge notifs-count">0</span>
                        <i class="fa fa-globe"></i>
                    </a>

                    <div class="dropdown-menu notifs-menu" aria-labelledby="notifs">
                        <div class="triangle-up-notifs"></div>
                    </div>
                        
                </div>

            </li>
            <!-- Ends Notifications Dropdown -->

			<li class="nav-item hover-dropdown my-2 my-lg-0">
				<a href="#" class="nav-link dropbtn" role="button"><i class="fa fa-user"></i></a>
                <div class="triangle-up user"></div>
				<div class="dropdown-menu dropdown-menu-right" role="menu" style="right: 15px;">
					<a class="dropdown-item" href="profile.php"><span class="glyphicon glyphicon-user"></span> <?php echo translate('profile') ?></a>
					<a class="dropdown-item" href="settings.php"><span class="glyphicon glyphicon-user"></span> <?php echo translate('settings') ?></a>
					<a class="dropdown-item" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <?php echo translate('logout') ?></a>
				</div>
			</li>
            <!-- Dropdown -->
		</ul>
	<?php } ?>
  </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 collapse" id="search">
            <form id="searchForm">
                <input type="text" name="search_keywords" placeholder="Rechercher n'importe quoi...">
                <select name="search_category" id="searchCat">
                    <option value="0">Toutes les annonces</option>
                    <?php
                        foreach (getCats() as $cat) {
                            echo '<option value="'.$cat['cat_id'].'">'.$cat['cat_name'].'</option>';
                        }
                    ?>
                </select>
                <select name="search_location" id="searchLoc">
                    <option value="0">Tous les wilayas</option>
                    <option value="1">01 - أدرار</option>
                    <option value="2">02 - الشلف</option>
                    <option value="3">03 - الأغواط</option>
                    <option value="4">04 - أم البواقي</option>
                    <option value="5">05 - باتنة</option>
                    <option value="6">06 - بجاية</option>
                    <option value="7">07 - بسكرة</option>
                    <option value="8">08 - بشار</option>
                    <option value="9">09 - البليدة</option>
                    <option value="10">10 - البويرة</option>
                    <option value="11">11 - تامنراست</option>
                    <option value="12">12 - تبسة</option>
                    <option value="13">13 - تلمسان</option>
                    <option value="14">14 - تيارت</option>
                    <option value="15">15 - تيزي وزو</option>
                    <option value="16">16 - الجزائر</option>
                    <option value="17">17 - الجلفة</option>
                    <option value="18">18 - جيجل</option>
                    <option value="19">19 - سطيف</option>
                    <option value="20">20 - سعيدة</option>
                    <option value="21">21 - سكيكدة</option>
                    <option value="22">22 - سيدي بلعباس</option>
                    <option value="23">23 - عنابة</option>
                    <option value="24">24 - قالمة</option>
                    <option value="25">25 - قسنطينة</option>
                    <option value="26">26 - المدية</option>
                    <option value="27">27 - مستغانم</option>
                    <option value="28">28 - المسيلة</option>
                    <option value="29">29 - معسكر </option>
                    <option value="30">30 - ورقلة</option>
                    <option value="31">31 - وهران</option>
                    <option value="32">32 - البيض</option>
                    <option value="33">33 - إليزي</option>
                    <option value="34">34 - برج بوعريريج</option>
                    <option value="35">35 - بومرداس</option>
                    <option value="36">36 - الطارف</option>
                    <option value="37">37 - تندوف</option>
                    <option value="38">38 - تيسمسيلت</option>
                    <option value="39">39 - الوادي</option>
                    <option value="40">40 - خنشلة</option>
                    <option value="41">41 - سوق أهراس</option>
                    <option value="42">42 - تيبازة</option>
                    <option value="43">43 - ميلة</option>
                    <option value="44">44 - عين الدفلى</option>
                    <option value="45">45 - النعامة</option>
                    <option value="46">46 - عين تموشنت</option>
                    <option value="47">47 - غرداية</option>
                    <option value="48">48 - غليزان</option>
                </select>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</div>