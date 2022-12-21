<?php

function child_header(){
    // echo 'hello';
}
add_action('astra_masthead_bottom', 'child_header');