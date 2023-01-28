<?php
/*---------------------Přidání fotografií do the_content----------------------*/

add_filter('the_content', 'pridat_galerie');
function pridat_galerie($content)
{
 //počítadlo, kolikrát probíhá tato funkce	
 global $pokolikate_content;
 $pokolikate_content = $pokolikate_content+1;

 if( is_page('fotogalerie') AND ($pokolikate_content == 1) ) {
 	 
  //vykreslení všech galerií od nejstarší, zjištění počtu galerií
  for ($i=1;;$i++)
  {
   $vsechny_galerie[$i] = do_shortcode('[jj-ngg-jquery-carousel gallery="' . $i . '" width="150" height="100" order="sortorder" gap="10" scroll="3" visible="3" animation="300" wrap="both" html_id="karusel" title="bez_titulku"]');
   $pocet_znaku_vykresleni = strlen($vsechny_galerie[$i]);
   //jestliže je toto ID galerie prázdné, skončit loop
   if ($pocet_znaku_vykresleni<=160) {
    break;
   }
   
   global $titulek_galerie;
   
   //přidáme info ke galerii
   $vsechny_galerie[$i] = '<br /><strong>Autor:</strong> Lucie Křesťanová</p>' . $vsechny_galerie[$i];
   $vsechny_galerie[$i] = '<br /><strong>Místo:</strong> Praha, Palackého náměstí' . $vsechny_galerie[$i];
   $vsechny_galerie[$i] = '<p><strong>Datum:</strong> 24. 9. 2011' . $vsechny_galerie[$i];   
   $vsechny_galerie[$i] = '<h3>' . $titulek_galerie . '</h3>' . $vsechny_galerie[$i];   
  }
 	 
  $pocet_galerii = ($i-1); 
  
  //vykreslení galerií od nejnovější
  $vsechny_galerie = array_reverse($vsechny_galerie);  
  foreach ($vsechny_galerie as $key=>$value){
   $new_content = $new_content . $value;
   //pomůcka ke stránkování
   //potom UPRAVIT podmínku ve stylu: pokud je násobkem 4-5 (každý desátý)
   if ($key == 1) {
    $new_content = $new_content . 'odstrankovat';	   
   }
  } 
 
 } else { 
  $new_content = $content;	 
 }
 	  
  return $new_content;	 
}

/*------------------Automatická paginace stránek s fotkami--------------------*/

add_action( 'the_post', 'paginate_post' );

function paginate_post( $post ) {

    global $pages, $multipage, $numpages;

    if( is_page('fotogalerie') ) {

	$multipage = 1;
	$content = apply_filters( 'the_content', $post->post_content );
	//$content = preg_replace('/<h\d>/', '<--nextpage-->$0', $content );
	//$content = preg_replace('/<h\d>/', '<--nextpage-->$0', $content );
	$content = str_replace('odstrankovat', '<!--nextpage-->', $content );
	//$pages = explode( '<--nextpage-->', $content );
	$pages = explode( '<!--nextpage-->', $content );
	$numpages = count( $pages );
    }
}

/*-------------Odebrání možnosti změnit kategorii v Rychlé úpravy-------------*/

function customAdminCSS() {
    echo '<style type="text/css">
    .inline-edit-col .inline-edit-categories-label, .inline-edit-col .category-checklist {
    	display: none !important;
    }
    </style>';
}
add_action('admin_head', 'customAdminCSS');

/*---------------------Registrování dynamického sidebaru----------------------*/

if(function_exists('register_sidebar'))
{
 register_sidebar(array(
  'name' => 'Pravý sloupec',	 
  'before_widget' => '<li id="%1$s" class="widget %2$s"><div class="widget-nahore"></div><div class="widget-stred">',
  'after_widget' => '</div><div class="widget-dole"></div></li>'
 ));
}

if(function_exists('register_sidebar'))
{
 register_sidebar(array(
  'name' => 'Spodní část vlevo',	 
  'before_widget' => '<div class="footer-widget_1">',
  'after_widget' => '</div>'
 ));
}

if(function_exists('register_sidebar'))
{
 register_sidebar(array(
  'name' => 'Spodní část uprostřed',	 
  'before_widget' => '<div class="footer-widget_2">',
  'after_widget' => '</div>'
 ));
}

if(function_exists('register_sidebar'))
{
 register_sidebar(array(
  'name' => 'Spodní část vpravo',	 
  'before_widget' => '<div class="footer-widget_3">',
  'after_widget' => '</div>'
 ));
}

/*---------Přidání class k první a poslední položce v menu, currenty----------*/

//function add_markup_categories($output) {
// $output = preg_replace('/cat-item/', 'menu-item_prvni', $output, 1);
// $output = substr_replace($output, " menu-item_posledni cat-item", strripos($output, "cat-item"), strlen("cat-item"));
// return $output;
//}
//add_filter('wp_list_categories', 'add_markup_categories');

function add_markup_categories($output) {
 //zjištění kategorie mimo category.php	
 if(!is_category() AND !is_page()) {
  $category = get_the_category($post->ID);
  $category_id = $category[0]->cat_ID;
  $nadrazena_category_id = $category[0]->parent; 
 //zjištění kategorie v category.php	 
 } else if (is_category()) {
  $category_id = get_query_var('cat'); 
  $cat = get_category($category_id);
  $nadrazena_category_id = $cat->category_parent;
 } else if (is_page('o-asociaci-asnep')) {
  //protože je to pod první hlavní kategorií, je potřeba oddělit další podmínky pro menu a submenu
  global $menicko;
  if($menicko == "menu") {  
   $nadrazena_category_id = "3";
  } else if ($menicko == "submenu") {   
   $category_id = "18"; 
  }
 } else if (is_page('videogalerie')) {
  $nadrazena_category_id = "10";
  $category_id = "22";   
 } else if (is_page('fotogalerie')) {
  $nadrazena_category_id = "10";
  $category_id = "21";   
 }

 // přidání currentu k první kategorii  
 if((is_single() OR is_category() OR is_page()) AND (($category_id=="3") OR ($nadrazena_category_id=="3"))) {
  $output = preg_replace('/cat-item/', 'menu-item_prvni current-menu_prvni', $output, 1);
  $output = substr_replace($output, " menu-item_posledni cat-item", strripos($output, "cat-item"), strlen("cat-item"));	 
 // přidání currentu k poslední kategorii  
 } else if((is_single() OR is_category() OR is_page()) AND (($category_id=="14") OR ($nadrazena_category_id=="14"))) {
  $output = preg_replace('/cat-item/', 'menu-item_prvni', $output, 1);
  $output = substr_replace($output, " menu-item_posledni current-menu_posledni cat-item", strripos($output, "cat-item"), strlen("cat-item"));
 // přidání currentu ke kategorii, ve které jsme 
 } else if((is_single() OR is_category() OR is_page())) {
  //var_dump($nadrazena_category_id);
  //var_dump($output);	 
  $output = preg_replace('/cat-item/', 'menu-item_prvni', $output, 1);
  $output = preg_replace('/cat-item-' . $category_id . '/', 'current-menu', $output);
  $output = preg_replace('/cat-item-' . $nadrazena_category_id . '/', 'current-menu', $output);
  $output = substr_replace($output, " menu-item_posledni cat-item", strripos($output, "cat-item"), strlen("cat-item"));
  
 // přidání class mimo single, category a page 
 } else {	 
  $output = preg_replace('/cat-item/', 'menu-item_prvni', $output, 1);
  $output = substr_replace($output, " menu-item_posledni cat-item", strripos($output, "cat-item"), strlen("cat-item"));
 } 
 return $output;
}
add_filter('wp_list_categories', 'add_markup_categories');

/*---------------Přidání class k poslední položce ve stránkách----------------*/

function add_markup_pages($output) {
 //$output= preg_replace('/page-item/', 'stranka_prvni', $output, 1);
 $output=substr_replace($output, " stranka_posledni page-item", strripos($output, "page-item"), strlen("page-item"));
 return $output;
}
add_filter('wp_list_pages', 'add_markup_pages');

/*-----------------Přidání class do excerptů na homepage----------------------*/

function add_excerpt_class( $excerpt )
{
 $excerpt = str_replace( "<p", "<p class=\"post\"", $excerpt );
 return $excerpt;
}
add_filter( "the_excerpt", "add_excerpt_class" );

/*-----------------Přidání class do contentů na homepage----------------------*/

function add_content_class( $content )
{
 $content = str_replace( "<p", "<p class=\"post\"", $content );
 return $content;
}
add_filter( "the_content", "add_content_class" );

?>
