<?php

// Remove extra <p> tags from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');
// Allow receiving email to have different domain than website
add_filter('wpcf7_validate_configuration', '__return_false');
