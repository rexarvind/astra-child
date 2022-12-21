<?php

function child_footer(){
    // echo 'hello';
}
add_action('astra_footer_before', 'child_footer');