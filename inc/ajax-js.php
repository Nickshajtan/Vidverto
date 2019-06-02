<script>
                                        jQuery("time.timeago").timeago(); 
                                        jQuery('.post').ready(function($){
                                           var name = jQuery('a[data-class=ajax-post], article[data-class=ajax-post]');
                                           name.find(".post-categories li a[href^='<?php echo home_url(); ?>/./all-news/']").css({display: 'none'});
                                           if( $('.switch_right').hasClass('active') ){
                                                name.removeClass();
                                                name.addClass('post post-line col-12');
                                                name.find('.content-wrapper.white__bottom').addClass('changed').removeClass('white__bottom');
                                                name.find('.content-wrapper.changed .white__block.d-flex').addClass('changed block').removeClass('white__block d-flex flex-column justify-content-between align-items-center');
                                                name.find('.content-wrapper.changed .content').addClass('changed').removeClass('d-flex flex-column justify-content-between align-items-center');
                                                name.find('.block .title').addClass('changed').removeClass('text-center');
                                           }
                                           $(document).on('click','.switch', function(e){
                                               $('.switch').removeClass('active');
                                               $(this).addClass('active');
                                               if( $(this).hasClass('right') ){
                                                    name.removeClass();
                                                    name.addClass('post post-line col-12');
                                                    name.find('.content-wrapper.white__bottom').addClass('changed').removeClass('white__bottom');
                                                    name.find('.content-wrapper.changed .white__block.d-flex').addClass('changed block').removeClass('white__block d-flex flex-column justify-content-between align-items-center');
                                                    name.find('.content-wrapper.changed .content').addClass('changed').removeClass('d-flex flex-column justify-content-between align-items-center');
                                                    name.find('.block .title').addClass('changed').removeClass('text-center');
                                               }
                                               if( $(this).hasClass('left') ){
                                                    name.removeClass();
                                                    name.addClass('post col-12 col-md-6 col-lg-4');
                                                    name.find('.block .title.changed').addClass('text-center');
                                                    name.find('.content-wrapper.changed').addClass('white__bottom');
                                                    name.find('.content-wrapper.changed .content.changed').addClass('d-flex flex-column justify-content-between align-items-center');
                                                    name.find('.block.changed').addClass('white__block');
                                               }
                                            });
                                        });
</script>