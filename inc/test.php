<?php

/**
 * Template Name: Welcome user new
 */

get_header();
$price = get_field('price', 'option');
$themnurl = get_stylesheet_directory_uri();


$header_img = get_the_post_thumbnail_url();


function show_this_page_header(){
    global $header_img;
    ?>
    <div class="position-relative">
        <img src="<?php echo $header_img; ?>" alt="background image" class="position-absolute w-100 h-100 object-cover object-center top-0 start-0 end-0 bottom-0 lazyloaded" />
        <span class="d-block position-absolute top-0 start-0 end-0 bottom-0 w-100 h-100" style="background-color:rgba(0,0,0,0.2);"></span>
        <div class="container-xl py-4 position-relative">
            <div class="py-md-5"></div>
            <h1 class="fs-1 mb-3 text-center text-white">User Details</h1>
            <p class="text-center my-0 pb-3 text-white"><a href="<?php echo home_url('/'); ?>" class="text-white">Home</a> <span class="px-2">/</span> <span class="text-white">User Details</span></p>
        </div>
    </div>
    <?php
}


?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<link href="<?php echo $themnurl; ?>/js/jquery.multiselect.css" rel="stylesheet" />
<script src="<?php echo $themnurl; ?>/js/jquery.multiselect.js"></script>
<style type="text/css">
    .Question {
        border: 0px solid #f3f3f3;
        width: 75%;
        padding: 0;
    }

    .Question label {
        font-size: 15px;
        text-transform: inherit;
        font-weight: 500;
    }

    .Question input[type=text],
    select {
        border-radius: 0;
        padding: 8px 20px;
        border: 1px solid #b9b9b9;
    }

    .Question label {
        font-weight: 700;
        margin-top: 7px;
    }

    .Question label.error {
        color: #f00;
        font-weight: 500;
        margin-top: 0;
        font-size: 14px;
    }

    #userupdate {
        width: 100%;
        border: 1px solid #f3f3f3;
        float: left;
        padding: 20px;
        margin-bottom: 20px;
    }

    .form-control {
        float: left;
        width: 100%;
        margin-bottom: 26px;
    }

    .form-control label {
        width: 18%;
        float: left;
    }

    .Question select {
        display: block;
        width: 100%;
        text-align: left;
        padding-left: 20px;
    }

    /** Payment button stye */
    a.pay-for-competetion {
        background: #ef9c35;
        padding: 10px 40px;
        border-radius: 37px;
        color: #fff;
        display: block;
        width: fit-content;
        margin: 10px 0 20px;
        font-size: 14px;
        border: 1px solid #ef9c35;
        font-weight: 700;
    }

    a.pay-for-competetion span.price {
        display: block;
        font-size: 22px;
        font-weight: 800;
        line-height: 28px;
    }

    a.pay-for-competetion:hover {
        background: #fff !important;
        color: #ef9c35;
        border: 1px solid #ef9c35;
    }

    a.pay-for-competetion.disable {
        opacity: 0.7;
        pointer-events: none;
        cursor: none;
        user-select: none;
    }

    h4.register-competetion-title {
        font-size: 26px;
        margin-bottom: 20px;
    }

    .Updatebtc img.bnimg {
        width: 10px
    }

    p.register-competetion-small-msg {
        color: #000;
        font-family: "Open sans";
        font-weight: 400;
        font-size: 18px;
    }

    /* change_add */
    .suggest_links_datta p {
        margin: 0;
        font-size: 16px;
        line-height: 1.7em;
        margin-bottom: 10px;
    }

    .suggest_links_datta a {
        color: #ea8822;
        font-weight: 700;
    }

    .suggest_links_datta {
        margin-bottom: 20px;
        padding: 0 15px;
    }

    h4.main-head-who {
        margin: 0;
        margin-bottom: 5px;
        font-size: 1.7em;
        line-height: 1.3em;
    }

    .suggest_links_datta .suugest_main,
    .suggest_links_datta .who_suggest,
    .suggest_links_datta .parti_suggest {
        margin-bottom: 15px;
    }

    .suggest_links_datta .step_suggest {
        margin-bottom: 25px;
    }

    .suggest_links_datta .step_suggest ul {
        margin: 0;
        padding-left: 20px;
    }

    .suggest_links_datta .step_suggest ul li {
        line-height: 1.7em;
    }

    .suggest_links_datta .parti_suggest h6,
    .suggest_links_datta .suugest_main p {
        font-size: 24px;
        line-height: 32px;
        margin: 0;
        margin-bottom: 10px;
        font-weight: 500;
    }
</style>
<script type="text/javascript">
    // $(document).ready(function() {
    jQuery(function($) {
        $("#userupdate").validate({
            submitHandler: function(form) {
                var name = $("input[name='name']").val();
                var age = $("select[name='age']").val();
                var school_or_institute = $("input[name='school_or_institute']").val();
                var city = $("input[name='city']").val();

                if (age == null) {
                    alert('Please provide age.');
                } else if (school_or_institute == null) {
                    alert('Please enter your school or institute name.');
                } else if (city == null) {
                    alert('Please enter your city.');
                } else {
                    $("#upd").html("processing <img class='bnimg' src='/wp-content/themes/best-simple-child-theme/assets/loading.gif'/>");
                    var ajaxurl = '<?php echo home_url('/'); ?>wp-admin/admin-ajax.php';
                    $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            action: 'register_update_new',
                            name: name,
                            age: age,
                            school_or_institute: school_or_institute,
                            city: city,
                        },
                        success: function(response) {
                            //jQuery("#successmsg").html(response);
                            setTimeout(function() {
                                window.location.href = window.location.href;
                            }, 1500);
                        }
                    })
                }
            }

        });

        $('select[multiple].active.1col').multiselect({
            columns: 1,
        });

    });

    function alertWithoutNotice(message) {
        setTimeout(function() {
            alert(message);
        }, 1000);
    }

    // $(function () {
    // });
</script>

<div id="primarys" class="content-area">
    <main id="main" class="site-main">


        


            <?php
            if (is_user_logged_in()) {

                $author_id = get_current_user_id();
                $current_user = wp_get_current_user();

                // $AccountPAID = get_field('account', 'user_'. $author_id );
                $AccountPAID = "YES";
                $name_user = get_field('name_user', 'user_' . $author_id);
                $age = get_user_meta($author_id, 'date_of_birthday', true);
                $gender = get_field('gender', 'user_' . $author_id);
                $types_of_books_read = get_field('types_of_books_read', 'user_' . $author_id);
                $tax =  explode(', ', $types_of_books_read);
                $bookchallage = $wpdb->get_results("select * from bookchallage  where userid='$author_id' AND 	admin_review='YES'");
                $show = count($bookchallage);

                if ($show == 0) {
                    $Number = 5;
                } else {
                    $bookchal = $show * 5;
                    $Number = $bookchal + 5;
                }

                if ($AccountPAID == "YES") {

                    echo "<h1 class='welcome' style='color:#111111;'>WELCOME $name_user TO THE BOOK READING JOURNEY</h1>";
                    if (!empty($age)) {
                        //$args = array(  'posts_per_page' => $Number,  'post_type'  => 'book','orderby' => 'menu_order',  'order' => 'ASC',);
                        //if(!empty($types_of_books_read)){
                        /*if($age==5||$age==6||$age==7){
							$age_group="5 to 7";
						}
						else if($age==8||$age==9){
							$age_group="8 to 9";
						}
						else if($age==10||$age==11){
							$age_group="10 to 11";
						}
						else if($age>=12||$age<=21){
							$age_group="12 to 21";
						}*/
                        //echo $age_group;
                        if ($age >= 1 && $age <= 7) {
                            //1.,2,3,4,5,6,7
                            $age_group = "BookList1";
                        } else if ($age >= 8 && $age <= 11) {
                            //8,9,10,11
                            $age_group = "BookList2";
                        } else if ($age >= 12 && $age <= 16) {
                            //12,13,14,15,16
                            $age_group = "BookList3";
                        } else if ($age >= 17 && $age <= 21) {
                            //17,18,19,20,21
                            $age_group = "BookList4";
                        } else if ($age >= 22 && $age <= 99) {
                            //22 to 99
                            $age_group = "BookList5";
                        }

                        $args = array(
                            'posts_per_page' => -1, 'post_type'  => 'book', 'orderby' => 'menu_order',  'order' => 'ASC',
                            'meta_query' => array(
                                'relation'  => 'AND',
                                array(
                                    'key'       => 'book_lists',
                                    'value'     => $age_group,
                                    'compare' => '='

                                )
                            )
                        );
                        //}
                        echo  get_field('welcome_text', 'option');
                        $account_paid = get_field('account', 'user_' . get_current_user_id()); ?>
                        <h4 class="register-competetion-title">Register for Book Reading Competition</h4>
                        <!-- <a href="<?php echo get_site_url(); ?>/pay/pay.php?token=<?php echo base64_encode($price); ?>" class="pay-for-competetion<?php if ($account_paid == 'YES') {
                                                                                                                                                            echo ' disable';
                                                                                                                                                        } ?>">
							<span class="price">Pay Rs. <?php echo $price; ?></span>
							Payment is secure with PAYTM Payment Gateway
						</a> -->
                        <?php if ($account_paid == 'YES') { ?>
                            <p class="register-competetion-small-msg">
                                <strong>Congratulations!!!</strong> You are now part of a wonderful <strong>Book Reading Competition!!!</strong> Pick a Book to Read and after finishing the book, click on <strong>'See Book Details' </strong>button below.
                                <br>
                                <br>
                                There you will find 2 buttons ‘I FINISHED READING THIS BOOK’ and ‘I WROTE THE BOOK REVIEW’. Click Both buttons, one after the other, accordingly and you will be presented with Questions. Answer them correctly and win <strong>Prizes!!!</strong>
                            </p>
                        <?php } ?>
                        <br>
                        <?php
                        echo  get_field('welcome_text_instruction', 'option');
                        $books = get_posts($args);
                        echo "<div class='not-bookling row gy-4 mb-5'>";
                        foreach ($books as $post) : setup_postdata($post);
                        ?>
                            <div class="not-bookgird col-6 col-md-4 col-lg-3">
                                <a href="<?php the_permalink(); ?>" class="book-effects card rounded-0 h-100 hover:shadow position-relative overflow-hidden">
                                    <div class="card-body px-0 pt-4 pb-2 d-flex flex-column">
                                        <div class="mb-3">
                                            <?php if (has_post_thumbnail($post->ID)) { ?>
                                                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium'); ?>
                                                <img src="<?php echo $image[0]; ?>" class="w-full h-auto d-block mx-auto" alt="" />
                                            <?php } ?>
                                        </div>
                                        <div class="mb-2 px-3 text-center mt-auto">
                                            <?php $tags = get_field("tags"); ?>
                                            <h3 class="booktite fw-semibold fs-5 mt-0 mb-2"><?php the_title(); ?></h3>
                                            <?php if ($tags) { ?><span class="lh-1"><?php echo $tags; ?></span><?php } ?>
                                            <?php if (false && $tags) : ?>
                                                <div style="font-size: 12px;">
                                                    <style>
                                                        span.flag {
                                                            background: #2e6092;
                                                            color: #fff;
                                                            padding: 5px;
                                                            position: absolute;
                                                            top: 4px;
                                                            left: 0;
                                                            border-radius: 4px;
                                                            z-index: 2;
                                                            margin-left: -2px;
                                                        }

                                                        span.flag:after {
                                                            content: "";
                                                            right: -14px;
                                                            position: absolute;
                                                            width: 19px;
                                                            height: 26px;
                                                            background-repeat: no-repeat;
                                                            top: 0;
                                                            background-image: url(/wp-content/themes/best-simple-child-theme/arrow.png);
                                                        }

                                                        span.flag span {
                                                            z-index: 9999;
                                                            position: relative;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <span class="flag">
                                                        <span><?php echo $tags; ?></span>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (false) { ?>
                                                <div class="author_div"><strong>Author: </strong><?php echo get_field("age_group"); ?></div>
                                                <div><strong>Avg. Reading Time: </strong><?php echo get_field("time_to_read"); ?> </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- <div class="card-footer card-footer-btn px-0 py-0">
        							<span class="d-block text-center py-2 fw-bold">See Book Details</span>
                                </div> -->
                                    <div class="book-effects-content text-center px-3 py-3 d-flex flex-column justify-content-center">
                                        <p class="mt-0 mb-3 lh-sm fw-bold fs-4 text-white"><?php the_title(); ?></p>
                                        <p class="mt-0 mb-2 lh-sm text-white"><strong>Author:</strong> <?php echo get_field('age_group'); ?></p>
                                        <p class="mt-0 mb-2 lh-sm text-white"><strong>Avg. Reading Time:</strong> <?php echo get_field('time_to_read'); ?></p>
                                        <div>
                                            <button type="button" class="book-effects-content-btn px-3 py-2 rounded-0">See Book Details</button>
                                        </div>
                                        <?php if ($tags) { ?><span class="lh-sm text-white d-block mt-3"><?php echo $tags; ?></span><?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php
                        endforeach;
                        wp_reset_postdata();
                        echo "</div>";
                    } else { ?>
                        <div class="Question">
                            <div id="successmsg"></div>
                            <form method="post" action="contact.php" id="userupdate">
                                <div class="form-control">
                                    <label>Name</label>
                                    <input type="text" name="name" style="width:40%" value="<?php echo $name_user;  ?>" required class="input-text" />
                                </div>
                                <div class="form-control">
                                    <label>Select Your Age</label>
                                    <select name="age" required style="width:80px" class="input-select">
                                        <?php
                                        for ($i = 1; $i <= 24; $i++) {
                                        ?><option value="<?php echo $i; ?>" <?php if ($i == 10) {
                                                                                echo 'selected';
                                                                            } ?>><?php echo $i; ?></option><?php
                                                                                                                                            }
                                                                                                                                                ?>
                                        <option value="25">25+</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label>School/Institute</label>
                                    <input type="text" name="school_or_institute" style="width:40%" required class="input-text">
                                </div>
                                <div class="form-control">
                                    <label>City</label>
                                    <input type="text" name="city" style="width:40%" required class="input-text">
                                </div>
                                <!--
							<input type="text"  name="age"  style="width:40%" required>
							<label>Please Select Gender</label>
							<select name="gender"  required>
								<option selected value> -- select an option -- </option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>-->
                                <div class="form-control">
                                    <button type="submit" class="Updatebtc" id="upd">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    <?php
                    }
                } else {

                    echo  get_field('payment_text', 'option'); ?>
                    <form method="post" class="paymentmatod" action="<?php echo get_site_url(); ?>/pay/pay.php">
                        <input type="hidden" name="user_email" id="contact" value="<?php echo $current_user->user_email; ?>">
                        <input type="hidden" name="cust_name" id="contact2" value="<?php echo $current_user->user_nicename; ?>">
                        <input type="hidden" name="cust_id" id="contact3" value="<?php echo $current_user->ID; ?>">
                        <input type="submit" value="Pay To Book Reading Competition" class='Challe'>
                    </form>
                <?php
                }
            } else {
                
                show_this_page_header();
                
                ?>
                <h1 class="titles"> <?php the_title(); ?></h1>
                <?php echo '<h1 class="dvf">Welcome, please <a href="' . get_permalink(80) . '" >Sign in </a> or <a href="' . get_permalink(13) . '">Sign up</a> for the Book Reading Competition.</h1>'; ?>
                <div class="suggest_links_datta">
                    <div class="suugest_main">
                        <p>Participate in WLARET’S <b>BOOK READING COMPETITION</b> ‘2022’ Online @ <a href="https://www.wlaret.com/sign-in/">www.WLARET.com</a>& get a chance to win Amazon’s <b>KINDLE</b> device</p>
                    </div>
                    <div class="who_suggest">
                        <h4 class="main-head-who">Who are we?</h4>
                        <p>We at <a href="https://www.wlaret.com/sign-in/">www.wlaret.com</a> suggest “The Best Books to Read” for all age groups every year. These books have been filtered and funneled from a list of 10,000 books worldwide. Reading these books will attribute to one’s overall development and also inculcate improvement in communication, literary and logical skills.</p>
                        <p>We have been conducting National Level ‘Online’ Book Reading Competitions over last 2 years. More than 40 Institutes and 1000+ Individuals are part of us. This is our 3rd Consecutive Competition where we have lots of exciting prizes for the winners. </p>
                        <p>The concept is to read as many books as you can, answer the quiz and win Prizes. You also have a chance of winning the most coveted Amazon’s KINDLE Device.</p>
                    </div>
                    <div class="step_suggest">
                        <h4 class="main-head-who">Steps to sign-up:</h4>
                        <ul>
                            <li>
                                Open the Website <a href="https://www.wlaret.com/sign-in/">www.wlaret.com</a>
                            </li>
                            <li>
                                Click on SIGN-UP Button
                            </li>
                            <li>
                                Enter your credentials to create the Account
                            </li>
                            <li>
                                Login into Account using SIGN-IN Button
                            </li>
                            <li>
                                Enter Your Age to see your Curated Book List and the Free E-Book
                            </li>
                            <li>
                                Register for the Competition and start Reading Books
                            </li>
                        </ul>
                    </div>
                    <div class="parti_suggest">
                        <h6>
                            Participate in WLARET’S <b>BOOK READING COMPETITION</b> ‘2022’ Online @ <a href="https://www.wlaret.com/sign-in/">www.WLARET.com</a> & get a chance to win Amazon’s <b>KINDLE</b> device
                        </h6>
                        <p>*Share this poster on your social media (WhatsApp or FB or Instagram or Twitter) and email screenshot to hello@wlaret.com; you will get a Rs. 50 discount on the Registration Fees!</p>
                    </div>
                </div>
                <?php
                $args = array('posts_per_page' => 5, 'post_type' => 'book', 'orderby' => 'menu_order', 'order' => 'ASC',);
                $loop = new WP_Query($args);
                if ($loop->have_posts()) {
                ?>
                    <div class="row gy-4 mb-5">
                        <?php while ($loop->have_posts()) {
                            $loop->the_post(); ?>
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="<?php echo get_permalink(80); ?>" class="card locked-books h-100 rounded-0 overflow-hidden">
                                    <div class="card-body px-0 py-0">
                                        <?php if (has_post_thumbnail($post->ID)) : ?>
                                            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium'); ?>
                                            <img src="<?php echo $image[0]; ?>" class="w-full h-auto d-block mx-auto" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer px-1 text-center fw-semibold">
                                        <?php the_title(); ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
            <?php wp_reset_postdata();
                }
            }
            ?>
    </main>
</div>

<script>
    function change() {
        if (age == null || school_or_institute == null || city == null) {
            $("#upd").hteml("SUBMIT");
        } else {
            $("#upd").hteml("processing <img class='bnimg' src='/wp-content/themes/best-simple-child-theme/assets/loading.gif'/>");
        }
    }
    // $(document).ready(function() {
    jQuery(function($) {
        $('#upd').on('click', function(e) {
            change();
        });
    });
</script>

<style>
    .locked-books {
        position: relative;
    }

    .locked-books::before {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        pointer-events: none;
        z-index: 1;
        background-repeat: no-repeat;
        background-size: 69px;
        background-position: center;
        background-image: url("data:image/svg+xml,%3Csvg fill='%2332B5F3' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'%3E%3Cpath d='M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z'/%3E%3C/svg%3E");
        background-color: rgba(0, 0, 0, 0.5);
        transition: opacity 400ms ease;
    }

    .locked-books:hover {
        box-shadow: 0px 15px 30px 0px rgba(0, 0, 0, 0.20);
    }

    .locked-books:hover::before {
        opacity: 1;
    }

    .locked-books:hover .card-body,
    .locked-books:hover .card-footer {
        filter: blur(5px);
    }

    .input-text,
    .input-select {
        border-radius: 4px !important;
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    }

    .card-footer-btn,
    .card-footer-btn a {
        background-color: #32B5F3 !important;
        color: #ffffff !important;
    }

    .card-footer-btn:hover,
    .card-footer-btn a:hover {
        background-color: #cccccc !important;
        color: #121212 !important;
    }

    .bookgird img {
        width: 200px;
        height: 300px;
    }

    .logged-in .bookgird {
        height: 600px !important;
        min-height: 630px !important;
        padding-top: 15px !important;
    }

    @media screen and (max-width: 787px) {
        span.flag span {
            line-height: 9px;
        }
    }

    @media screen and (min-width: 1040px) {
        a.bookReadtite {
            padding: 5px 20px !important;
            font-size: 15px !important;
        }

    }

    @media screen and (max-width: 1040px) and (min-width: 600px) {
        .logged-in .bookgird {
            width: 46% !important;
            height: 630px !important;
        }
    }

    @media(max-width:1025px) {

        .suggest_links_datta .parti_suggest h6,
        .suggest_links_datta .suugest_main p {
            font-size: 22px;
            line-height: 30px;
        }

        h4.main-head-who {
            font-size: 1.3em;
        }
    }

    @media (max-width: 1024px) {
        a.bookReadtite {
            font-size: 14px !important;
        }
    }

    @media (max-width: 1024px) {
        #userupdate input[type='text'] {
            width: 100% !important;
        }

        #userupdate select {
            width: 27% !important;
        }

        #userupdate label {
            width: 100%;
        }

        .Question {
            width: 100%;
        }
    }

    @media(max-width:992px) {

        .suggest_links_datta .parti_suggest h6,
        .suggest_links_datta .suugest_main p {
            font-size: 18px;
        }

        h4.main-head-who {
            font-size: 1.2em;
        }

        .suggest_links_datta .step_suggest ul li {
            font-size: 14px;
        }
    }

    @media(max-width:575px) {

        .suggest_links_datta .parti_suggest h6,
        .suggest_links_datta .suugest_main p {
            font-size: 18px;
            line-height: 26px;
        }

        .suggest_links_datta .parti_suggest p {
            font-size: 13px;
        }

        .suggest_links_datta {
            padding: 0 10px;
        }
    }

    .author_div {
        font-size: 14px;
        line-height: 16px;
    }

    .book-effects {
        position: relative;
    }

    .book-effects::before {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        opacity: 0;
        z-index: 3;
        transition: opacity 300ms;
        background-color: rgba(50, 181, 243, 0.9);
    }

    .book-effects:hover::before {
        opacity: 1;
    }

    .book-effects-content {
        position: absolute;
        top: 90px;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 4;
        opacity: 0;
        pointer-events: none;
        transition: all 400ms ease;
    }

    .book-effects:hover .book-effects-content {
        top: 0;
        opacity: 1;
    }

    .book-effects:hover .book-effects-content-btn {
        pointer-events: auto !important;
        background-color: #32B5F3 !important;
        border: 2px solid #ffffff !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        font-family: "Open Sans", sans-serif;
    }

    .book-effects:hover .book-effects-content-btn:hover {
        color: #121212 !important;
        background-color: #ffffff !important;
    }
</style>
<?php
get_footer();
