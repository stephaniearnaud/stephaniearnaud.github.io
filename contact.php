<!-- <?php
$dest    = 'arnaud.stephanie@gmail.com<script type="text/javascript">
/* <![CDATA[ */
(function(){try{var s,a,i,j,r,c,l,b=document.getElementsByTagName("script");l=b[b.length-1].previousSibling;a=l.getAttribute('data-cfemail');if(a){s='';r=parseInt(a.substr(0,2),16);for(j=2;a.length-j;j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}s=document.createTextNode(s);l.parentNode.replaceChild(s,l);}}catch(e){}})();
/* ]]> */
</script>';
 
if(!$_POST['name'] && $_POST['email'] && $_POST['message'])
    echo 'Please enter you name.';
elseif($_POST['name'] && !$_POST['email'] && $_POST['message']){
    echo 'Please enter your email.';
    }
elseif($_POST['name'] && $_POST['email'] && !$_POST['message']){
    echo 'Please enter your message.';
    }
elseif($_POST['name'] && $_POST['email'] && $_POST['message']){
    $_POST   = array_map('htmlspecialchars', $_POST);
    $from    = 'From: '.$_POST['email']."\r\n";
    $objet   = 'stephaniearnaud.me Contact Form';
    if(!preg_match('!^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$!',$_POST['email']))
        echo 'Please enter a valid email address.';
    else{
        mail($dest, $objet, $_POST['message'], $from);
        echo 'Your message has been succesfully sent! Thank you!';
        }
    }
?> -->

<?php
require_once("includes/Akismet.class.php");
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$url = ""; //my contact form doesn't require a URL modify if your's does

if (isset($email) &&  !empty($email)) {

$apikey = 'eb8292eacd91';
$blogurl = 'http://stephaniearnaud.me/';
$akismet = new Akismet($blogurl ,$apikey);
$akismet->setCommentAuthor($name);
$akismet->setCommentAuthorEmail($email);
$akismet->setCommentAuthorURL($url);
$akismet->setCommentContent($message);
$akismet->setPermalink('http://stephaniearnaud.me/');
if($akismet->isCommentSpam()) {
$myFile = "spam.txt";
$fh = fopen($myFile, 'a') or die("can't open spam file");
$stringData = sprintf("Name: %s\r\nEmail: %s \r\nMessage: %s\r\n------------------------------------\r\n",$name,$email,$want,$message);
fwrite($fh, $stringData);
fclose($fh);
} else {
$header = "From: " . $name . " <" . $email . ">\r\n";
$to = "mail@domain.com";
$subject = "domain.com website contact";
$body = "I want: " . $want . "\r\n" . $message;
mail($to,$subject, $body, $header);
}

$loadtime = $_POST["loadtime"];

$totaltime = time() - $loadtime;

if($totaltime < 7) {
    echo("Please fill in the form before submitting!");
    exit;
}

$spa = $_POST["spam"];

if (!empty($spa) && !($spa == "4" || $spa == "four")) {
    echo "You failed the bot test!";
    exit ();
}

}
?>