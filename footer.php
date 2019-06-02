              <footer>
                   <div class="container">
                       <div class="row">
                           <div class="col-12 col-md-12 col-lg-3 justify-content-center d-flex align-items-center">
                               <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); }?>
                           </div>
                           <div class="col-12 col-md-3 col-lg-2">
                               <?php if ( is_active_sidebar( 'footer' ) ) : ?> 
                                   <?php dynamic_sidebar( 'footer' ); ?>
                               <?php endif; ?>
                           </div>
                           <div class="col-12 col-md-5 col-lg-4">
                               <div class="row">
                                   <div class="col-12 col-md-6 col-lg-6 bold">
                                       <?php if( has_nav_menu('social' ) ) : ?> 
                                          <p class="header"> <?php echo __('Соціальні мережі'); ?><?php wp_nav_menu(array('theme_location'  => 'social')); ?></p>
                                       <?php endif; ?>
                                   </div>
                                   <div class="col-12 col-md-6 col-lg-6">
                                       <?php if( has_nav_menu('footer' ) ) : ?>
                                           <p class="header"><?php echo __('Реклама'); ?><?php wp_nav_menu(array('theme_location'  => 'footer')); ?></p>
                                       <?php endif; ?>
                                    </div>
                               </div>
                           </div>
                           <div class="col-12 col-md-3 col-lg-3 d-flex flex-column bold">
                               <?php
                                $contact_text = get_option('site_telephone');
                                $phone = get_option('site_telephone_tel');
                                $contact_text_two = get_option('site_telephone_two');
                                $phone_two = get_option('site_telephone_two_tel');
                                $email = get_option('site_email');
                               ?>
                                <p class="header"><?php echo __('Телефонна лінія'); ?></p>
                                <?php $phone_line = get_option("vidverto_phones"); ?>
                                <?php if( isset($phone_line) && !empty($phone_line) ):  ?>
                                    <?php foreach ($phone_line as $element) : ?>
                                        <a href="tel:<?php echo $element; ?>"  class="phone_line text-dark"><?php echo $element; ?></a>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <a href="<?php if(!empty($phone)){ echo 'tel:' . $phone; }else{ echo '#'; } ?>"  class="text-dark"><?php if(!empty($contact_text)){ echo $contact_text; } ?></a>
                                    <a href="<?php if(!empty($phone_two)){ echo 'tel:' . $phone_two; }else{ echo '#'; } ?>"  class="text-dark"><?php if(!empty($contact_text_two)){ echo $contact_text_two; } ?></a>
                                <?php endif; ?>
                                <?php $phones_email = get_option("vidverto_email"); ?>
                                <?php if( isset( $phones_email ) && !empty( $phones_email ) ) : ?>
                                         <p class="header"><?php echo __('Email'); ?></p>
                                         <a href="mailto:<?php echo $phones_email; ?>" class="text-dark"><?php echo $phones_email; ?></a>
                                <?php else : ?>
                                    <?php if(!empty($email)) : ?>
                                        <p class="header"><?php echo __('Email'); ?></p>
                                        <a href="mailto:<?php echo $email; ?>" class="text-dark"><?php echo $email; ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                           </div>
                       </div>
                   </div>
                   <div class="container">
                       <div class="row">
                           <div class="col-12 d-flex flex-column justify-content-center align-items-center copyright">
                               <p class="d-block w-50 text-center" style="border-top: 1px solid #ddd;padding-top: 10px;"><?php echo __('Всі права захищені'); ?> / <?php echo date('Y'); ?></p>
                               <p>Created by HCC</p>
                           </div>
                       </div>
                   </div>
               </footer>
            </div>
        <?php wp_footer(); ?>
    </body>
    <script>
        jQuery(document).ready(function($){
                  var one = $('a.phone_line');
                  one.each(function(){
                      var text = $(this).attr('href');
                      var regex = /[0-9^+\d]|\./;
                      text = text.replace(/[^+\d]/g, '');
                      text = 'tel:' + text;
                      $(this).attr('href', text);
                  });   
        });
    </script>
    <?php if( is_paged() || is_home() || is_front_page() || is_search() || is_category() ) : ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
               $('.paginations .prev').attr('rel', 'prev'); 
               $('.paginations .next').attr('rel', 'next'); 
            });
        </script>
        <script type="text/javascript">
          //  $.noConflict();
            jQuery(document).ready(function($){
                var ias = jQuery.ias( {
                  container: ".posts-wrapper",
                  item: ".post",
                  pagination: ".pagination",
                  next: ".next.page-numbers",
                } );

                ias.extension( new IASTriggerExtension( { offset: 2 } ) );
                ias.extension( new IASSpinnerExtension() );
                ias.extension( new IASNoneLeftExtension() );  
            });
        </script>
        <?php endif; ?>
        <script>jQuery(document).ready(function($){
                    $(document).find(".post-categories li a[href^='<?php echo home_url(); ?>/./all-news/']").css({display: 'none'});
                });
        </script>
        <script>
            jQuery(document).ready(function($){
                $(document).find(".post-categories li a[href^='<?php echo home_url(); ?>/./all-news/']").css({display: 'none'});
                $(document).ready(function(){
                       $("time.timeago").timeago(); 
                });
            });
        </script>
        <?php if( is_front_page() || is_home() ) : ?>
        <?php /* My test code for push */ ?>
        <script>
            /*
                Push.config ({serviceWorker: '//serviceWorker.min.js'});
                Push.create('Заголовок', {
                body: 'Текст внутри уведомления',
                icon: 'http://imapo.ru/img/blockquote_bg.png', // Иконка уведомления
                timeout: 5000, // Через сколько закроется уведомление
                tag: 'notice', // Если задан, по этому параметру можно закрыть уведомление и такое уведомление появится лишь один раз
                onClick: function () {
                window.focus(); // После клика по уведомлению нас вернёт во вкладку, откуда оно пришло
                this.close(); // Само уведомление будет закрыто
            }
            });
            */
        </script>
        <?php /* End test code */ ?>
        <?php endif; ?>
</html>