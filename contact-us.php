<?php
ob_start();
$pageTitle = 'Contactez nous';
include 'init.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <form id="contact-us">
                <h1>Contactez nous!</h1>
                <p>Dis bonjour! Ou ce que vous voulez!</p>
                <input class="feild" name="name" type="text" placeholder="Nom" id="name" required />
  
                <input class="feild" name="email" type="email" placeholder="Email" id="email" required />
  
                <textarea class="feild" name="text" rows="3" placeholder="Message"></textarea>
  
                <div class="checkbox">
                    <label><input type="checkbox" class="human_veryfication" /> Oui, je suis humain!</label>
                </div>
 
                <input type="submit" class="feild" value="Envoyer" id="button-blue"/>
            </form>

        </div>
    </div>
</div>
<?php

include $tpl . 'footer.php';
ob_end_flush();
?>