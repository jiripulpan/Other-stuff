<?php
function str_replace_last( $search , $replace , $str ) {
    if( ( $pos = strrpos( $str , $search ) ) !== false ) {
        $search_length  = strlen( $search );
        $str    = substr_replace( $str , $replace , $pos , $search_length );
    }
    return $str;
}
function specialCharacter($email) {
    return str_replace('@', '&#64;', $email);
}
function atAndDot($email) {
    $email = str_replace_last('.', ' dot ', $email);
    return str_replace('@', ' at ', $email);
}
function codeAround($email) {
    return str_replace('@', '<code>@</code>', $email);
}
?>
<h1>hide email from spambots</h1>
<br>
<br><b>Use of at and dot: </b>
<a href="mailto:<?php echo atAndDot('news@mydomain.com'); ?>">Write me an email!</a>
<br><b>Use of < code >: </b>
<a href="mailto:<?php echo codeAround('news@mydomain.com'); ?>">Write me an email!</a>
<br><b>Use of Special HTML Character: </b>
<a href="mailto:<?php echo specialCharacter('news@mydomain.com'); ?>">Write me an email!</a>
