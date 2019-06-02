<?php
/**
 * File for functions and definitions of the theme
 *
 * Contain loading of styles and scripts
 *
 */
//Style css
add_action('wp_enqueue_scripts', 'load_sec_css');
function load_sec_css() {
    $url = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css';
    $response = wp_remote_get('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    $code = wp_remote_retrieve_response_code( $response );
    if ( !is_wp_error( $response ) ){
        if( isset( $url ) && !empty( $url) && ( $code == '200') ){
            wp_register_style( 'b4', $url, array(), ' ' );
            wp_enqueue_style( 'b4' );
        }
    }
    else{
        wp_register_style( 'b4', get_template_directory_uri() . '/style/bootstrap.min.css', array(), ' ' );
        wp_enqueue_style( 'b4' );
    }
    wp_register_style( 'mine',  get_template_directory_uri() . '/style/mine.css', array(), ' ' );
    wp_enqueue_style( 'mine');
    wp_register_style( 'styles', get_stylesheet_uri(), array(), ' ' );
    wp_enqueue_style( 'styles' );
}
//JQUERY
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method() {
    $url = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js';
    $response = wp_remote_get('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    $code = wp_remote_retrieve_response_code( $response );
    if ( !is_wp_error( $response ) ){
        if( isset( $url ) && !empty( $url) && ( $code == '200') ){
        	wp_deregister_script( 'jquery-core' );
	        wp_register_script( 'jquery-core', $url ,array(), null, true);
	        wp_enqueue_script( 'jquery' );
        }
    }
    else{
            wp_deregister_script( 'jquery-core' );
	        wp_register_script( 'jquery-core', get_theme_file_uri( 'js/jquery-3.3.1.min.js' ) ,array(), null, true);
	        wp_enqueue_script( 'jquery' );
    }
}
//Load js
add_action( 'wp_enqueue_scripts', 'load_js' );
function load_js() {
     wp_register_script('custom', get_theme_file_uri( 'js/custom.js' ), array( 'jquery' ), null, true );
     wp_enqueue_script('custom');
     $wnm_custom = array( 'template_url' => get_bloginfo('template_url'), 'admin_url' => get_bloginfo('admin_url'), 'url' => get_bloginfo('url') );
     wp_localize_script( 'custom', 'wnm_custom', $wnm_custom );
     wp_register_script('time', get_theme_file_uri( 'js/jquery.timeago.js' ), array( 'jquery' ), null, true );
     wp_enqueue_script('time');
     wp_register_script('time-loc', get_theme_file_uri( 'js/jquery.timeago.uk.js' ), array( 'jquery' ), null, true );
     wp_enqueue_script('time-loc');
    if( is_home() || is_front_page() ){
                wp_register_script( 'push', get_theme_file_uri( 'js/push.min.js' ), array( 'jquery' ), null, true );
                wp_enqueue_script('push');
    }
    if( is_home() || is_paged() || is_front_page() || is_single() || is_category() || is_search() ){
                wp_register_script( 'mihdan-infinite-scroll', get_theme_file_uri( 'js/jquery-ias.min.js' ), array( 'jquery' ), null, true );
                wp_enqueue_script('mihdan-infinite-scroll');
                 //$wnm_custom = array( 'ajax_text_button' => get_field('text_for_ajax_button_more','options'), 'ajax_end_load' => get_field('text_fo_end_of_ajax_load','options') );
                 //wp_localize_script( 'mihdan-infinite-scroll', 'wnm_custom', $wnm_custom );
    }
}
/**
 * Disable the confirmation notices when an administrator
 * changes their email address.
 *
 * @see http://codex.wordpress.com/Function_Reference/update_option_new_admin_email
 */
function wpdocs_update_option_new_admin_email( $old_value, $value ) {

    update_option( 'admin_email', $value );
}
add_action( 'add_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );
add_action( 'update_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );
//Remove admin pages

function remove_menus(){
    //remove_menu_page( 'edit.php' ); 
    //remove_menu_page( 'users.php' );
    remove_menu_page( 'edit-comments.php' );   
}
add_action( 'admin_menu', 'remove_menus' );
//Copyright
function add_copyright_text() {
	$currenturl = get_permalink();
 ?>
 
<script type='text/javascript'>
function addLink() {
    if (
window.getSelection().containsNode(
document.getElementsByClassName('global-wrapper')[0], true)) {
    var body_element = document.getElementsByTagName('body')[0];
    var selection;
    selection = window.getSelection();
    var oldselection = selection
    var pagelink = "<br /><br /> Content is taken from the original source:  <?php echo $currenturl; ?> ";
    var copy_text = selection + pagelink;
    var new_div = document.createElement('div');
    new_div.style.left='-99999px';
    new_div.style.position='absolute';
 
    body_element.appendChild(new_div );
    new_div.innerHTML = copy_text ;
    selection.selectAllChildren(new_div );
    window.setTimeout(function() {
        body_element.removeChild(new_div );
    },0);
}
}
 
document.oncopy = addLink;
</script>
<?php
}
add_action( 'wp_footer', 'add_copyright_text');
//Setup
add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
if ( function_exists( 'add_image_size' ) ) {
	add_image_size('content-big', 1150, 800, array( 'left', 'top' ));
    add_image_size('content-middle', 760, 800, array( 'left', 'top' ));
    add_image_size('content-small', 400, 600, array( 'left', 'top' ));
    /*add_image_size('sidebar', 300, 9999, array( 'left', 'top' ));*/
}
if ( ! function_exists( 'theme_setup' ) ) :
function theme_setup(){
    //Add support theme html 5    
    add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption') ); 
    //Add custom logo
    add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 300,
		'flex-height' => false,
	) );
}
endif;
add_action( 'after_setup_theme', 'theme_setup' );
remove_filter('the_content', 'wpautop');
add_theme_support( 'post-thumbnails' );
//No slash
add_filter('user_trailingslashit', 'no_page_slash', 70, 2);
function no_page_slash( $string, $type ){
   global $wp_rewrite;

	if( $type == 'page' && $wp_rewrite->using_permalinks() && $wp_rewrite->use_trailing_slashes )
		$string = untrailingslashit($string);

   return $string;
}
//No robots
function meta_robots () {
if (is_feed() or is_single() or is_category() or is_author() or is_archive() or is_month() or is_date() or is_day() or is_year() or is_tag() or is_tax() or is_attachment() or is_paged() or is_search() or is_404())
{
echo "".'<meta name="robots" content="noindex,nofollow" />'."\n";
} }
add_action('wp_head', 'meta_robots');
//Is mobile
function is_mobile(){
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	if(
		// добавить '|android|ipad|playbook|silk' в первую регулярку для определения еще и tablet
		@preg_match(
			'/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i|android|ipad|playbook|silk',
			$useragent
		)
		||
		@preg_match(
			'/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
			substr($useragent,0,4)
		)
	)
		return true;
	return false; 
}
function cc_mime_types($mimes) {
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
//Breadcrumbs
function the_breadcrumb(){
global $post;
if(!is_home()){ 
   echo '<a href="'.site_url().'">Home</a> >> ';
	if(is_single()){ // записи
	the_category(', ');
	echo " >> ";
	the_title();
	}
	elseif (is_page()) { // страницы
		if ($post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">>' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' >> ';
		}
		echo the_title();
	}
	elseif (is_category()) { // категории
		global $wp_query;
		$obj_cat = $wp_query->get_queried_object();
		$current_cat = $obj_cat->term_id;
		$current_cat = get_category($current_cat);
		$parent_cat = get_category($current_cat->parent);
		if ($current_cat->parent != 0) 
			echo(get_category_parents($parent_cat, TRUE, ' >> '));
		single_cat_title();
	}
	elseif (is_404()) { // если страницы не существует
		echo 'Error 404';
	}
 
	if (get_query_var('paged')) // номер текущей страницы
		echo ' (' . get_query_var('paged').'-я страница)';
 
} else { // главная
   $pageNum=(get_query_var('paged')) ? get_query_var('paged') : 1;
   if($pageNum>1)
      echo '<a href="'.site_url().'">Home</a> >> '.$pageNum.'-я страница';
}
}
//title
add_theme_support('title-tag');
//Register sidebars
/*add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	register_sidebar( array(
		'name'          => 'Хедер',
		'id'            => "header",
		'description'   => 'Віджети для хедера',
		'class'         => '',
		'before_widget' => '',
		'after_widget'  => "",
		'before_title'  => '',
		'after_title'   => "",
	) );
}
*/
add_action( 'widgets_init', 'register_my_widgets_footer' );
function register_my_widgets_footer(){
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => "footer",
		'description'   => 'Віджети для футера',
		'class'         => 'sidebar_footer',
		'before_widget' => '',
		'after_widget'  => "",
		'before_title'  => '<p class="header">',
		'after_title'   => "</p>",
	) );
}
add_action( 'widgets_init', 'register_my_widgets_sidebar' );
function register_my_widgets_sidebar(){
	register_sidebar( array(
		'name'          => 'Права колонка',
		'id'            => "sidebar",
		'description'   => 'Віджети у правій колонці',
		'class'         => 'sidebar_right',
		'before_widget' => '',
		'after_widget'  => "",
		'before_title'  => '<span class="sr-only d-none">',
		'after_title'   => "</span>",
	) );
}
add_action( 'widgets_init', 'register_my_widgets_main' );
function register_my_widgets_main(){
    register_sidebar( array(
		'name'          => 'Перша колонка',
		'id'            => "sidebar_one",
		'description'   => 'Віджет у середині сторінки',
		'class'         => 'sidebar_main',
		'before_widget' => '',
		'after_widget'  => "",
		'before_title'  => '<span class="sr-only d-none">',
		'after_title'   => "</span>",
	) );
    register_sidebar( array(
		'name'          => 'Друга колонка',
		'id'            => "sidebar_two",
		'description'   => 'Віджет у середині сторінки',
		'class'         => 'sidebar_main',
		'before_widget' => '',
		'after_widget'  => "",
		'before_title'  => '<span class="sr-only d-none">',
		'after_title'   => "</span>",
	) );
    register_sidebar( array(
		'name'          => 'Третя колонка',
		'id'            => "sidebar_three",
		'description'   => 'Віджет у середині сторінки',
		'class'         => 'sidebar_main',
		'before_widget' => '',
		'after_widget'  => "",
		'before_title'  => '<span class="sr-only d-none">',
		'after_title'   => "</span>",
	) );
    register_sidebar( array(
		'name'          => 'Четверта колонка',
		'id'            => "sidebar_four",
		'description'   => 'Віджет у середині сторінки',
		'class'         => 'sidebar_main',
		'before_widget' => '',
		'after_widget'  => "",
		'before_title'  => '<span class="sr-only d-none">',
		'after_title'   => "</span>",
	) );
}
//JS async
function add_async_attribute($tag, $handle) {
   $scripts_to_async = array();
   
   foreach($scripts_to_async as $async_script) {
      if ($async_script === $handle) {
         return str_replace(' src', ' async src', $tag);
      }
   }
   return $tag;
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}
//Email form
add_action( 'wp_ajax_ajax_order', 'ajax_mail_function' ); // wp_ajax_{ЗНАЧЕНИЕ ПАРАМЕТРА ACTION!!}
add_action( 'wp_ajax_nopriv_ajax_order', 'ajax_mail_function' );  // wp_ajax_nopriv_{ЗНАЧЕНИЕ ACTION!!}
function ajax_mail_function(){
    //Variables
        $headers = "Content-type: text/html; charset=utf-8\r\n";
        $sitename = get_bloginfo('name');
        $admin_email = get_field('contact_mail','options');
        $subject = "Новое сообщение с сайта ". $sitename;
        $user_name = htmlspecialchars(trim($_POST['name']));
        $user_phone = htmlspecialchars(trim($_POST['phone']));
        $spam_first = (trim($_POST['spamFirst']));
        $spam_second = (trim($_POST['spamSecond']));
if( (isset( $spam_first ) && !empty( $spam_first )) || (isset( $spam_second ) && !empty( $spam_second) )){
    exit;
}    
    //    $id = trim($_POST['page']);
        $message = '<html>
<head>
     <meta charset="UTF-8">
     <title>Форма обратной связи</title>
</head>
<body>
    <body style="width:94%; height:auto;">
    <table style="width:100%; max-width:600px;height:auto;vertical-align: middle;border-color:#000;border:0px;border-style:solid;border-spacing:unset;padding:0;" summary="форма заявки" rules="none" frame="border" cellpadding="0" cellspacing="0">
        <caption align="justify" style="height: 45px;">
            <h2 style="margin: 5px;font-size: 1.5rem;">Сообщение</h2>
        </caption>
        <thead align="justify" style="background-color:#ddd;border-color:#000;border:1px;border-style:solid;">
            <tr style="height: 30px;">
                <td align="center" style="width:100%;" colspan="4">
                    <h3 style="margin:5px;font-size: 1.1rem;">' . $subject . '</h3>
                </td>
            </tr>
        </thead>
        <tbody style="font-size: 1rem;">';
if(isset($user_name)&&!empty($user_name)) {       
  $message .= '<tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                <td style="border-right: 1px solid #ccc;padding-left:25px;">Имя отправителя:</td>
                <td style="border-left: 1px solid #ccc;padding-left:25px;">'. $user_name .'</td>
            </tr>';
}
if(isset($user_phone)&&!empty($user_phone)) {     
   $message .=   '<tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                <td style="border-right: 1px solid #ccc;padding-left:25px;">
                    Номер телефона:
                </td>
                <td style="border-left: 1px solid #ccc;padding-left:25px;">
                    '. $user_phone .'
                </td>
            </tr>';
}
    $message .= '<tr style="height:90px;width:auto;">
               <td colspan="4" align="center">
                        <a href="'. get_bloginfo("url") . '/wp-admin" style="background-color:#1eb4e9;border:none; width: 70%;padding: 16px 15px;-webkit-border-radius: 49px;border-radius: 49px;margin:16px 0;color:#fff;font-size: 1rem;text-decoration:none;font-weight:600;">АДМИНИСТРИРОВАТЬ</a>
               </td>
            </tr>';
        mail($admin_email,$subject,$message,$headers);
}
//Customizer
//Add custom bg
/*
function true_custom_background_support(){
    add_theme_support( 'custom-background' );
    add_theme_support( 'custom-header' );
}
add_action('after_setup_theme', 'true_custom_background_support');
*/
function mytheme_customize_register( $wp_customize ) {
$wp_customize->add_section(
    // ID
    'data_site_section',
    // Arguments array
    array(
        'title' => 'Контактні дані сайту',
        'capability' => 'edit_theme_options',
        'description' => "Тут можно вказати контакти сайту"
    )
); 
$wp_customize->add_section(
    // ID
    'data_settings_section',
    // Arguments array
    array(
        'title' => 'Налаштування сайту',
        'capability' => 'edit_theme_options',
        'description' => "Додаткові налаштування сайту"
    )
);
$wp_customize->add_section(
    // ID
    'data_social_section',
    // Arguments array
    array(
        'title' => 'Поділитися у соцмережах',
        'capability' => 'edit_theme_options',
        'description' => "Тут потрібно вказати налаштування для соцмереж"
    )
);
$wp_customize->add_section(
    // ID
    'data_error_section',
    // Arguments array
    array(
        'title' => 'Сторінка 404',
        'capability' => 'edit_theme_options',
        'description' => "Тут можно вказати поля для 404 сторінки"
    )
);
$wp_customize->add_setting(
    'breadcrumbs',
    array('default' => 'none')
);
$wp_customize->add_control(
    'breadcrumbs',
    array(
        'type' => 'select',
        'label' => 'Навігація "Хлібні крошки"',
        'section' => 'data_settings_section',
        'choices' => array(
            'block' => 'Показати',
            'none' => 'Сховати'
        ),
    )
);    
$wp_customize->add_setting(
    // ID
    'site_facebook',
    // Arguments array
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'site_facebook',
    // Arguments array
    array(
        'type' => 'text',
        'label' => "Текст(посилання/код href) для facebook",
        'section' => 'data_social_section',
        // This last one must match setting ID from above
        'settings' => 'site_facebook'
    )
);
$wp_customize->add_setting(
    'fb_show',
    array('default' => 'block')
);
$wp_customize->add_control(
    'fb_show',
    array(
        'type' => 'select',
        'label' => 'Іконка Facebook"',
        'section' => 'data_social_section',
        'choices' => array(
            'block' => 'Показати',
            'none' => 'Сховати'
        ),
    )
);   
$wp_customize->add_setting(
    // ID
    'site_inst',
    // Arguments array
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'site_inst',
    // Arguments array
    array(
        'type' => 'text',
        'label' => "Текст(посилання/код href) для instagram",
        'section' => 'data_social_section',
        // This last one must match setting ID from above
        'settings' => 'site_inst'
    )
);
$wp_customize->add_setting(
    'inst_show',
    array('default' => 'block')
);
$wp_customize->add_control(
    'inst_show',
    array(
        'type' => 'select',
        'label' => 'Іконка Instagram"',
        'section' => 'data_social_section',
        'choices' => array(
            'block' => 'Показати',
            'none' => 'Сховати'
        ),
    )
);  
$wp_customize->add_setting(
    // ID
    'site_tw',
    // Arguments array
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'site_tw',
    // Arguments array
    array(
        'type' => 'text',
        'label' => "Текст(посилання/код href) для telegram",
        'section' => 'data_social_section',
        // This last one must match setting ID from above
        'settings' => 'site_tw'
    )
);
$wp_customize->add_setting(
    'tw_show',
    array('default' => 'block')
);
$wp_customize->add_control(
    'tw_show',
    array(
        'type' => 'select',
        'label' => 'Іконка Telegram"',
        'section' => 'data_social_section',
        'choices' => array(
            'block' => 'Показати',
            'none' => 'Сховати'
        ),
    )
);  
$wp_customize->add_setting(
    // ID
    'site_telephone',
    // Arguments array
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'site_telephone',
    // Arguments array
    array(
        'type' => 'text',
        'label' => "Текст з телефоном",
        'section' => 'data_site_section',
        // This last one must match setting ID from above
        'settings' => 'site_telephone'
    )
);
$wp_customize->add_setting(
    // ID
    'site_telephone_tel',
    // Arguments array
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'site_telephone_tel',
    // Arguments array
    array(
        'type' => 'text',
        'label' => "Текст з телефоном для протоколу tel",
        'section' => 'data_site_section',
        // This last one must match setting ID from above
        'settings' => 'site_telephone_tel'
    )
);
$wp_customize->add_setting(
    // ID
    'site_telephone_two',
    // Arguments array
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'site_telephone_two',
    // Arguments array
    array(
        'type' => 'text',
        'label' => "Текст з телефоном",
        'section' => 'data_site_section',
        // This last one must match setting ID from above
        'settings' => 'site_telephone_two'
    )
);
$wp_customize->add_setting(
    // ID
    'site_telephone_two_tel',
    // Arguments array
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'site_telephone_two_tel',
    // Arguments array
    array(
        'type' => 'text',
        'label' => "Текст з телефоном для протоколу tel",
        'section' => 'data_site_section',
        // This last one must match setting ID from above
        'settings' => 'site_telephone_two_tel'
    )
);  
$wp_customize->add_setting(
    // ID
    'site_email',
    // Arguments array
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'site_email',
    // Arguments array
    array(
        'type' => 'text',
        'label' => "Контактний email",
        'section' => 'data_site_section',
        // This last one must match setting ID from above
        'settings' => 'site_email'
    )
);
$wp_customize->add_setting(
    // ID
    'site_error',
    // Arguments array
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'site_error',
    // Arguments array
    array(
        'type' => 'text',
        'label' => "Текст сторінки",
        'section' => 'data_error_section',
        // This last one must match setting ID from above
        'settings' => 'site_error'
    )
);
$wp_customize->add_setting('img-upload');
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'img-upload',
        array(
            'label' => 'Завантаження зображення 404 сторінки',
            'section' => 'data_error_section',
            'settings' => 'img-upload'
        )
    )
);
}
add_action( 'customize_register', 'mytheme_customize_register' );

class My_Register_Widget extends WP_Widget {
 
	/*
	 * create widget
	 */
	function __construct() {
		parent::__construct(
			'true_top_widget', 
			'Регистрация на сайте', // заголовок виджета
			array( 'description' => 'Позволяет вывести ссылку на регистрацию.' ) // описание
		);
	}
 
	/*
	 * frontend widget
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)
		$posts_per_page = $instance['posts_per_page'];
 
		echo $args['before_widget'];
 
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
 
		$q = new WP_Query("posts_per_page=$posts_per_page&orderby=comment_count");
		if( $q->have_posts() ):
			?>
            <ul class="register">
		        <li><?php wp_register(); ?></li>
			    <li><?php wp_loginout(); ?></li>	    
			</ul>
			<?php endif;
		wp_reset_postdata();
 
		echo $args['after_widget'];
	}
    /*
     * backend widget
     */
    public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
        ?>
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <?php
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}
 
/*
 * widget register
 */
function true_top_posts_widget_load() {
	register_widget( 'My_Register_Widget' );
}
add_action( 'widgets_init', 'true_top_posts_widget_load' );
//Menus
add_action( 'after_setup_theme', 'theme_register_nav_menu' );
function theme_register_nav_menu() {
	register_nav_menu( 'main', 'Головне меню' );
	register_nav_menu( 'social', 'Соціальні мережі' );
	register_nav_menu( 'footer', 'Футер меню' );
}
//Disable visual editor for adv
add_action('admin_init', 'disable_content_editor');
function disable_content_editor(){
    if (isset($_GET['post'])) {
        $post_ID = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_ID = $_POST['post_ID'];
    }

    if (!isset($post_ID) || empty($post_ID)) {
        return;
    }

    $page_template = get_post_meta($post_ID, '_wp_page_template', true);
    if ($page_template == 'adv.php') {
        //remove_post_type_support('post', 'editor');
        add_filter('user_can_richedit', '__return_false');
        return false;
    }
}
//Add meta-box for adv
add_action('add_meta_boxes', 'my_extra_fields', 1);
function my_extra_fields() {
    if (isset($_GET['post'])) {
        $post_ID = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_ID = $_POST['post_ID'];
    }

    if (!isset($post_ID) || empty($post_ID)) {
        return;
    }

    $page_template = get_post_meta($post_ID, '_wp_page_template', true);
    if ($page_template == 'adv.php') {
	    add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'post', 'normal', 'high'  );
    }
}
add_action('add_meta_boxes', 'my_extra_fields_two', 1);
function my_extra_fields_two() {
        if (isset($_GET['post'])) {
        $post_ID = $_GET['post'];
        } else if (isset($_POST['post_ID'])) {
            $post_ID = $_POST['post_ID'];
        }

        if (!isset($post_ID) || empty($post_ID)) {
            return;
        }
        $post_type = get_post_type($post_ID);
        $page_template = get_post_meta($post_ID, '_wp_page_template', true);
        if( $post_type == 'post' && $page_template != 'adv.php'){
           add_meta_box( 'extra_fields_two', 'Стиль відображення', 'extra_fields_box_func_two', 'post', 'normal', 'high'  ); 
        }
}
function extra_fields_box_func( $post ){
?>
    <p>Вставте у це поле посилання на рекламу, якщо ж потрібно вставити код використайте основний блок вище</p>
	<p><label><input type="text" name="extra[title]" value="<?php echo get_post_meta($post->ID, 'title', 1); ?>" style="width:50%" /> Посилання на зовнішню рекламу</label></p>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<?php
}
function extra_fields_box_func_two( $post ){
?>
    <p>Оберіть стиль відображення карточки запису</p>
	<p>
        <?php $mark_v = get_post_meta($post->ID, 'my_checkbox', 1); ?>
	    <label><input type="hidden" name="extra[my_checkbox]" value="" /> </label>
	    <label><input type="radio" name="extra[my_checkbox]" value="" <?php checked( $mark_v, '' ); ?> /> Прозора лінія унизу</label>
        <label><input type="radio" name="extra[my_checkbox]" value="white" <?php checked( $mark_v, 'white' ); ?> />Біла лінія унизу</label>
	</p>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<?php
}
add_action( 'save_post', 'my_extra_fields_update', 0 );
function my_extra_fields_update( $post_id ){
    if (
		   empty( $_POST['extra'] )
		|| ! wp_verify_nonce( $_POST['extra_fields_nonce'], __FILE__ )
		|| wp_is_post_autosave( $post_id )
		|| wp_is_post_revision( $post_id )
	)
		return false;
    $_POST['extra'] = array_map( 'sanitize_text_field', $_POST['extra'] );
    foreach( $_POST['extra'] as $key => $value ){
		if( empty($value) ){
			delete_post_meta( $post_id, $key );
			continue;
		}
    update_post_meta( $post_id, $key, $value );
    }
    return $post_id;
}
//hook for adv content
apply_filters( 'the_content', get_the_content() );

//Fix 404 error for pagination

function codernote_request($query_string ) {
    if( !is_home() && !is_front_page() && !(is_singular( 'post' ) || is_singular( 'page' ) ) ){
      if ( isset( $query_string['page'] ) ) {
        if ( ''!=$query_string['page'] ) {
          if ( isset( $query_string['name'] ) ) {
            unset( $query_string['name'] ); }
          }
        }
    }
    return $query_string;
}
add_filter('request', 'codernote_request');
add_action('pre_get_posts', 'codernote_pre_get_posts');

function codernote_pre_get_posts( $query ) {
  if( !is_home() && !is_front_page() && !(is_singular( 'post' ) || is_singular( 'page' ) ) ){
        if ( $query->is_main_query() && !$query->is_feed() && !is_admin() ) {
        $query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) );
    }   
  }  
}
//Add settings theme page
function setup_theme_admin_menus() {
    add_theme_page('Контактні дані сайту', 'Контакти', 'edit_theme_options', 'my-unique-identifier', 'theme_front_page_settings'); 
}
add_action('admin_menu', 'setup_theme_admin_menus');
function theme_front_page_settings() {
    if (!current_user_can('manage_options')) {
        wp_die('У Вас недостатньо прав для редагування цієї сторінки.');
    } 
?>
    <div class="wrap">
        <?php screen_icon('themes'); ?> <h2>Контактні телефони:</h2>
        <p>Додавайте по одному</p>
    </div>
    <hr>
    <form method="POST" action="">
        <table id="phone_table" class="form-table" style='width:50%;float:left;' >
           <?php 
                 $phones = get_option("vidverto_phones");
                 $phones_tel = get_option("vidverto_phones_tel"); 
                 $phones_email = get_option("vidverto_email"); 
    
           ?>
           <?php if( isset($phones) && !empty($phones) && isset($phones_tel) && !empty($phones_tel) ) : ?>
            <?php $element_counter = 1; foreach ($phones as $element) : ?>
            <tr valign="top" id="phones-line-<?php echo $element_counter; ?>" class="phone-line" data-val="<?php echo $element_counter; ?>">
                <td><label id="label_<?php echo $element_counter; ?>" for="phone-<?php echo $element_counter; ?>" data-type="text">Телефон:</label></td><td><input id="phone-<?php echo $element_counter; ?>" type="text" name="phone_<?php echo $element_counter; ?>" size="25" value="<?php echo $element; ?>"/></td>
                <td><label id="label_tel_<?php echo $element_counter; ?>" for="phone-tel-<?php echo $element_counter; ?>" data-type="tel">Телефон для протоколу tel:</label></td><td><input id="phone-tel-<?php echo $element_counter; ?>" type="tel" name="phone_tel_<?php echo $element_counter; ?>" size="25" required="required" onkeypress='validate(event)' value="<?php echo $element; ?>"/></td>
            </tr>
            <?php $element_counter++; endforeach; ?>
            <?php else : ?>
            <tr valign="top" id="phones-line-1" class="phone-line" data-val="1">
                <td><label id="label_1" for="phone-1" data-type="text">Телефон:</label></td><td><input id="phone-1" type="text" name="phone_1" size="25" value=""/></td>
                <td><label id="label_tel_1" for="phone-tel-1" data-type="tel">Телефон для протоколу tel:</label></td><td><input id="phone-tel-1" type="tel" name="phone_tel_1" size="25" required="required"  value=""/></td>
            </tr>
            <?php endif; ?>
            <input type="hidden" name="element-max-id" value="1"/>
        </table>
        <table id="mail_table" class="form-table" style='width:50%;float:left;' >
            <tr valign="top">
                <td><label for="email" name="email_label">Контактний email:</label></td><td><input id="email" name="email_input" type="email" value="<?php echo $phones_email; ?>"></td>
            </tr>
        </table>
        <table class="form-table" style='width:60%'>
            <tr>
                <td><button id="plus_phone" style="height:30px" class="button-primary">Додати телефон</button><button id="minus_phone" style="height:30px" class="button-primary">Видалити телефон</button><input type="submit" value='Зберегти' name="update_settings" id="save_phone" style="height:30px" class="button-primary"></td>
            </tr>
        </table>
        <input type="hidden" name="update_settings" value="Y" />
    </form>
    <script type="text/javascript">
        function validate(evt) {
              var theEvent = evt || window.event;
              var key = theEvent.keyCode || theEvent.which;
              key = String.fromCharCode( key );
              var regex = /[0-9^+\d]|\./;
              if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
              }
            }
        jQuery(document).ready(function() {
            var all = jQuery('.phone-line').last().attr('data-val').toString();
            var elementCounter = all;
            jQuery("input[name=element-max-id]").val(all);
            elementCounter = parseInt( elementCounter ) + 1;
            jQuery("#plus_phone").click(function(e) {
                e.preventDefault();
                var elementRow = jQuery('.phone-line').last().clone();
                var newId = "phones-line-" + elementCounter.toString();
                elementRow.attr("id", newId);
                elementRow.attr("data-val", Number(elementCounter));
                elementRow.show();
                var inputField = jQuery(elementRow).find("input[type=text]");
                var inputField2 = jQuery(elementRow).find("input[type=tel]");
                inputField.attr("name", "phone_" + String(elementCounter));
                inputField.attr("id", "phone-" + String(elementCounter));
                inputField2.attr("name", "phone_tel_" + String(elementCounter));
                inputField2.attr("id", "phone-tel-" + String(elementCounter));
                inputField.val('');
                inputField2.val('');
                var labelField = jQuery(elementRow).find("label[data-type=text]");
                var labelField2 = jQuery(elementRow).find("label[data-type=tel]");
                labelField.attr("for", "phone-" + String(elementCounter)); 
                labelField.attr("id", "label_" + String(elementCounter)); 
                labelField2.attr("for", "phone-tel-" + String(elementCounter)); 
                labelField2.attr("id", "label_tel_" + String(elementCounter)); 

                elementCounter++;
                jQuery("input[name=element-max-id]").val(String(elementCounter));

                jQuery(elementRow).appendTo("#phone_table tbody");

                return false;
            });
            jQuery("#minus_phone").click(function(e) {
                e.preventDefault();
                var max = parseInt(jQuery("input[name=element-max-id]").val());
                var element = jQuery(".phone-line");
                if( max > 2 ){
                    element.each(function(){
                        if( parseInt(jQuery(this).attr('data-val')) === max - 1 ){
                            jQuery(this).remove();
                        }
                    });
                    max = max-1;
                    jQuery("input[name=element-max-id]").val(max);
                }
            });
        }); 
    </script>
<?php 
    if (isset($_POST["update_settings"])) {
        $phones = array();
        $phones_tel = array();
        $phones_email = '';
        $max_id = esc_attr($_POST["element-max-id"]);
        for ($i = 0; $i < $max_id; $i ++) {
            $field_name = "phone_" . $i;
            $field_tel_name = "phone_tel_" . $i;
            if (isset($_POST[$field_name])) {
                $phones[] = esc_attr($_POST[$field_name]);

            }
            if (isset($_POST[$field_tel_name])) {
                $phones_tel[] = esc_attr($_POST[$field_tel_name]);
            }
        }
        if (isset($_POST["email_input"])) {
            $phones_email = esc_attr($_POST["email_input"]);
        }
        update_option("vidverto_phones", $phones);
        update_option("vidverto_phones_tel", $phones_tel);
        update_option("vidverto_email", $phones_email);
         
        ?>
        <div id="message" class="updated">Зміни збережено. Оновіть сторінку</div>
        <?php
    }
}