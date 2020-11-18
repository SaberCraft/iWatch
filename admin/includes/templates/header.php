 <!DOCTYPE html>
 <html>
 <head>
	 <meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 <title><?php getTitle() ?></title>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

 	<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>font-awesome.min.css">
 	<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>bootstrap-tagsinput.css">
 	<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>admin.css">
<style>
/* start main rules */

body {
	margin: 0;
	padding: 0;
	background-color: #F4F4F4;
}
input {
	position: relative;
  background-color: #fcfcfc;
}
input[type="radio"] {
    height: 12px;
    width: 12px;
}
.card-deck {
    padding: 15px;
}
label {
	font-size: 12px;
}

/* start login form */

.login {
	padding: 15px;
	background-color: #fff;
	border: 1px solid #F44336;
	border-radius: 3px;
}
.login .input-group {
	margin-bottom: 5px;
}
.login .form-control {
	background-color: #fff;
}
.login .btn {
	background-color: #F44336;
	color: #fff;
}

/* Start Bootstrap Edits */
.navbar {
	border-radius: 0;
	margin-bottom: 0;
}
.navbar-inverse {
    background-color: #343A40;
}
.navbar-inverse .navbar-brand {
    color: #ffffff;
}
.navbar-right {
	margin-right: 2px;
}
.panel-heading {
	font-size: 18px;
}
.navbar-nav i {
	font-size: 20px;
}
.navbar-inverse .navbar-nav li a {
    color: #9ba1a7;
    font-size: 15px;
}
.navbar-inverse .navbar-nav li a:hover {
    text-decoration: underline;
}
.navbar-nav ul .dropdown-menu {
  display: none;
	position: absolute;
	background-color: #eaeaea;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.navbar-nav .dropdown:hover .dropdown-menu {
    display: block;
}
.navbar-nav ul.dropdown-menu li a:hover {
    text-decoration: none;
    background-color: #343A40;
    color: #fff;
}
.navbar-nav ul.dropdown-menu li a {
    padding: 5px 0px 7px 15px;
    color: #343A40;
}
.navbar-nav .dropdown:hover .dropbtn {
    text-decoration: underline;
    color: #fff;
}
.form-control-feedback {
    position: relative;
    top: -40px;
    right: -424px;
}
.categories .panel-heading {
    color: #e9ecef;
    background-color: #7991a9;
    border-color: #d6e9c6;
}
.form-horizontal .group-select .control-label {
    padding-top: 10px;
    font-size: 18px;
}
.form-horizontal .group-select select {
    font-size: 18px;
	padding: 10px 16px;
    line-height: 1.3333333;
	color: #635f5f;
    height: 44px;
	border-color: #b6c3ce;
    border-radius: 6px;
}
.form-horizontal .group-select select:focus {
    border-radius: 6px;
}

/* Start Dashboard Page */

.home-stats .stat {
	color: #fff;
	border-radius: 8%;
	font-size: 16px;
	margin: 10px 0px;
	position: relative;
  overflow: hidden;
}
.home-stats .stat .info {
  float: right;
  padding: 10px;
  padding-right: 20px;
  padding-bottom: 0;
  font-size: 18px;
}
.home-stats .stat i {
	position: absolute;
	font-size: 80px;
  top: 10px;
  left: 25px;
}
.home-stats a:hover {
	text-decoration: none;
}
.home-stats .stat span {
	display: block;
	font-size: 50px;
}
.latest .toggle-latest {
	color: #999;
	cursor: pointer;
}
.latest .toggle-latest:hover {
	color: #444;
}
.latest-users {
	margin-bottom: 0;
}
.latest-cmts {
	margin-bottom: 0;
}
.latest-users li {
	background-color: #F2F2F2;
	padding: 5px;
	margin: 5px;
	font-size: 16px;
	font-weight: bold;
	vertical-align: middle;
	overflow: hidden;
}
.latest-cmts li {
	background-color: #F2F2F2;
	padding: 5px;
	margin: 5px;
	overflow: hidden;
}
.latest-users li:hover {
	background-color: #e7e7e7;
	color: #F44336;
	font-size: 18px;
	font-weight: bold;
}
.latest-cmts li:hover {
	background-color: #bbb;
}
.latest-users .btn {
	padding: 2px 5px;
	margin-left: 5px;
}
.latest-cmts .btn {
	padding: 2px 5px;
	margin-left: 5px;
}
.latest-users .btn:hover {
	padding: 2.5px 6px;
	margin-left: 5px;
}
.latest-cmts .btn:hover {
	padding: 2.5px 6px;
	margin-left: 5px;
}
.latest-cmts p {
	display: inline-block;
	word-wrap: break-word;
	max-width: 900px;
}


/* Dashbord Comments */
.comment-section-container {
  background-color: #fefefe;
  padding: 1rem;
}

.comment-section-author {
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  margin-bottom: 1rem;
}
.comment-section-author img {
	width: 50px;
    height: 50px;
	border-radius: 50%;
}

.comment-section-author .comment-section-name {
  margin-left: 1rem;
}
.comment-section-author .comment-section-name h5 {
  font-size: 16px;
}

.comment-section-author .comment-section-name p {
  margin-bottom: 0;
}

.comment-section-box {
  background-color: #e6e6e6;
  padding: 1rem;
}


/* Start Categories Page */
.categories .cat {
	position: relative;
	overflow: hidden;
	min-height: 84px;
}
.categories .cat:hover {
	background-color: #fcfcfc;
	border: 1.2px solid #a0b78c;
}
.categories .cat h3 {
	cursor: pointer;
	margin: 0;
}
.categories .cat:hover .hidden-catStat-btns {
	bottom: 5px;
}

.categories .cat p {
	-webkit-transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	transition: all .2s ease-in-out;
	word-wrap: break-word;
	max-width: 320px;
}
.categories .cat:hover p {
	margin-bottom: 30px;
}
.categories .cat .hidden-catStat-btns {
	-webkit-transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	transition: all .2s ease-in-out;
	position: absolute;
	bottom: -31px;
}
.categories .cat hr {
	margin-top: 10px;
	margin-bottom: 5px;
}
.categories .cat .hidden-catStat-btns a {
	font-size: 13.4px;
}
.categories .cat .hidden-catOpt-btns {
	position: absolute;
	top: 5.5px;
	right: -36.9px;
}
.categories .cat:hover .hidden-catOpt-btns {
	right: 5px;
}
.categories .cat .hidden-catOpt-btns .dropdown-menu {
    display: none;
    position: absolute;
	background-color: #f9f9f9;
	text-align: center;
	top: -2px;
    right: 37px;
    min-width: 114px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}
.categories .cat .hidden-catOpt-btns .dropdown:hover .dropdown-menu {
    display: block;
}
.categories .cat .hidden-catOpt-btns .dropdown-menu a {
	padding: 5px 0px;
}
.categories .cat .hidden-catOpt-btns .optbtn-edit:hover {
	background-color: #46B8DA;
	color: #fff;
	font-weight: bold;
}
.categories .cat .hidden-catOpt-btns .optbtn-sup:hover {
	background-color: #D9534F;
	color: #fff;
	font-weight: bold;
}
.categories .cat .hidden-catOpt-btns .btn:focus {
	background-color: #E6E6E6;
	border-color: #8c8c8c;
}
.categories .cat .hidden-catOpt-btns .dropdown:hover .btn {
	background-color: #E6E6E6;
	border-color: #8c8c8c;
}
.categories .cat .hidden-catOpt-btns .optbtn-edit {
	color: #46B8DA;
	font-weight: bold;
}
.categories .cat .hidden-catOpt-btns .optbtn-sup {
	color: #D9534F;
	font-weight: bold;
}
.categories .options {
	color: #000;
	font-size: 17px;
	text-align: center;
	padding-top: 32px;
}
.categories .options .view span {
	cursor: pointer;
}
.categories .options a {
	text-decoration: none;
	color: #000;
}
.categories .options .active {
	color: #fff;
	background-color: grey;
}

/* Start profile settings */

.profile-side-links {
	border: 2px solid #343A40;
	border-right: none;
}
.profile-image {
    margin: 15px 33px 5px;
    border: 1px solid #343A40;
}
.profile-side-links hr {
    border-color: #343A40;
}
.p-links {
    margin: 0;
}
.p-links ul {
	list-style-type: none;
    padding: 0;
}
.p-links ul li {
    margin: 0;
}
.p-links ul li a {
    display: block;
    text-decoration: none;
    padding: 5px;
    color: #343A40;
    font-size: 15px;
}
.p-links ul li a:hover {
	background-color: #343A40;
    color: #fff;
    padding: 5px;
}
.edit-profile-header {
	text-align: center;
    border: 2px solid #343A40;
}
.edit-profile-header p {
    font-size: 16px;
}
.edit-profile-body {
    padding-top: 15px;
	border: 2px solid #343A40;
	border-top: none;
}
.edit-profile-body label {
font-size: 16px;
}
.add-user-header {
	float: left;
	margin-top: 20px;
	padding: 5px 20px;
	text-align: center;
}
.add-user-body {
	float: left;
	margin-bottom: 20px;
	padding: 20px;
	border-top: none;
}
/* Ends Profile Settings */

.show-pass {
	position: absolute;
	font-size: 1.7em;
	top: 11px;
	right: 50px;
}

.main-table {
	-webkit-box-shadow: 0 3px 10px #F44336;
	-moz-box-shadow: 0 3px 10px #F44336;
	box-shadow: 0 3px 10px #F44336;
}

.main-table>tbody>tr>td {
	vertical-align: middle;
}

.main-table thead tr:first-child th {
	background-color: #F44336;
	color: #fff;
	text-align: center;

}
.main-table .btn {
	padding: 4px 10px;
}


	</style>
 </head>
  <body>
