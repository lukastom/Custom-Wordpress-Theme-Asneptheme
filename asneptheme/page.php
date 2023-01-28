   <?php get_header(); ?>
   
   <!-- vyhledávání -->
    <form id="searchform" action="<?php bloginfo('url'); ?>" method="get">
     <div>
      <input id="searchbutton" type="submit" value="Hledat" />
      <input id="searchwindow" type="text" name="s" value="Hledat" onfocus="if (this.value == 'Hledat') this.value = '';" />
     </div>
    </form>    
 
   </div>    

   <!-- menu - hlavní -->
   <div id="menu" style="height: 37px;"> <!-- pro submenu je to 37px, tedy to co je default v CSS -->
    <ul>     
     <?php global $menicko; $menicko = "menu"; wp_list_categories('depth=1&title_li=&hide_empty=0'); ?> <!-- CURRENTY: current-menu_prvni, current-menu, current-menu_posledni -->
    </ul>    
   </div>
   
   <!-- submenu -->

   <div id="submenu">
    <ul>
     <?php  
      if (is_page('o-asociaci-asnep')) {
       $nadrazena_kategorie_ted = "3";		      
      } else if ((is_page('videogalerie')) OR (is_page('fotogalerie'))) {
       $nadrazena_kategorie_ted = "10";		      
      }
      $menicko = "submenu"; 
      wp_list_categories('child_of=' . $nadrazena_kategorie_ted . '&title_li=&hide_empty=0');
     ?>
    </ul>    
   </div>  
   
   <div id="main">

    <div id="menu_stin"></div>
   
    <div id="wrap_sloupcu">
    
     <!-- posty -->
     <div id="levy_sloupec">
             
      <?php if(have_posts()) : while(have_posts()) : the_post(); ?> 
       
      <div class="clanek page-clanek">
       <div>
        <h2><?php the_title(); ?></h2>
       </div>
       <div id="single_po_excerptu">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
       </div>
      </div>  
      
     <?php endwhile; ?> 
      
     <?php else : ?>
      </p>Zde nejsou žádné články. 
     <?php endif; ?>
     
    </div>
    
   <?php get_sidebar('Pravý sloupec'); ?>   

   </div>
   
   <div id="stranka_konec"></div>

   </div>

   <?php get_footer(); ?>