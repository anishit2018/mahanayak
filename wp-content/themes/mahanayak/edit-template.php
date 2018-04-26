<?php
/*
 * Template Name: Edit
 */
/*
 * if user allready logged in then
 * redirect this user to profile page.
 */
logged_in_user_checking(TRUE,site_url());
$encrypted_id = $_GET["postId"];
$decrypted_id_raw = base64_decode($encrypted_id);
$decrypted_id = intval(str_replace('MY_SECRET_STUFF', '', $decrypted_id_raw));
$postDetails = get_post($decrypted_id);
/*echo "<pre>";
print_r($postDetails);
echo "</pre>";*/
get_header(); ?>

<section class="section-content pv12" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/coming-bg.jpg">
    <div class="container">
        <div class="row">

        </div>
    </div>
    <div class="container">
        
        <div class="clearfix"></div>
        
        <?php
        
        if($postDetails->post_type=='event')
            echo do_shortcode('[cr_event_form postid='.$decrypted_id.']');
        else if($postDetails->post_type=='song')
            echo do_shortcode('[cr_song_form postid='.$decrypted_id.']');    
        else if($postDetails->post_type=='gallery')
            echo do_shortcode('[cr_gallery_form postid='.$decrypted_id.']');            
        else
            echo do_shortcode('[cr_fans_form postid='.$decrypted_id.']');
            
            
        ?>
        
		<div class="clearfix"></div>
		
    </div>
</section>          

<?php get_footer(); ?>
<script>
$(document).ready(function () {
    
    $( "#tabs" ).tabs();
    
    $('#frmevent').validate({ // initialize the plugin
        rules: {
            event_name: {
                required: true,
                //email: true
            },
            hosted_by: {
                required: true,
                //minlength: 5
            },
            start_from_date: {
                required: true,
                //minlength: 5
            },
            end_from_date: {
                required: true,
                //minlength: 5
            },
            start_time: {
                required: true,
                //minlength: 5
            },
            end_time: {
                required: true,
                //minlength: 5
            },
            venue: {
                required: true,
                //minlength: 5
            },
            contact_name: {
                required: true,
                //minlength: 5
            },
            contact_number: {
                required: true,
                //minlength: 5
            },
            contact_email: {
                required: true,
                //minlength: 5
            },
            event_file: {
                required: true,
                extension: "jpg|jpeg|png"
            },
        },
        submitHandler: function (form) {
            //alert('valid form submitted');
            return true; // for demo
        }
    });
        
        $('#frmfans').validate({ // initialize the plugin
            rules: {
                fans_title: {
                    required: true,
                    //email: true
                },
                fans_content: {
                    required: true,
                    //email: true
                },
                fans_file: {
                    required: true,
                    //email: true
                },
            },
            submitHandler: function (form) {
                //alert('valid form submitted');
                return true; // for demo
            }
        });
            
            $('#frmgallery').validate({ // initialize the plugin
                rules: {
                    image_title: {
                        required: true,
                        //email: true
                    },
                    image_file: {
                        required: true,
                        //email: true
                    },
                },
                submitHandler: function (form) {
                    //alert('valid form submitted');
                    return true; // for demo
                }
            });
                
                $('#frmsong').validate({ // initialize the plugin
                    rules: {
                        music_title: {
                            required: true,
                            //email: true
                        },
                        movie_name: {
                            required: true,
                            //email: true
                        },
                    },
                    submitHandler: function (form) {
                        //alert('valid form submitted');
                        return true; // for demo
                    }
                });
                    
                    
               
});
    </script>
