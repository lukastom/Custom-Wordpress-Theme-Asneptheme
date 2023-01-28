   <?php get_header(); ?>
   
   <!-- vyhledávání -->
    <form id="searchform" action="<?php bloginfo('url'); ?>" method="get">
     <div>
      <input id="searchbutton" type="submit" value="Hledat" />
      <input id="searchwindow" type="text" name="s" value="<?php the_search_query(); ?>" />
     </div>
    </form>    
 
   </div>   

   <!-- menu - hlavní -->
   <div id="menu" style="height: 31px;"> <!-- pro submenu je to 37px, tedy to co je default v CSS -->
    <ul>
     <?php wp_list_categories('depth=1&title_li=&hide_empty=0'); ?> <!-- CURRENTY: current-menu_prvni, current-menu, current-menu_posledni -->
    </ul>    
   </div>
   
   <div id="main">

    <div id="menu_stin"></div>
   
    <div id="wrap_sloupcu">
    
     <!-- posty -->
     <div id="levy_sloupec">
     
      <h3>Výsledky vyhledávání:</h3>
     
      <?php
       $pocitadlo_excerptu = 0; 
      
       if(have_posts()) : while(have_posts()) : the_post(); 
       
       $pocitadlo_excerptu = $pocitadlo_excerptu + 1; ?>
       
       <div class="clanek">
        <?php include("vypsat_prilohy.php"); ?> 
        <!-- excerpt -->
        <?php the_excerpt(); ?>
        <a class="clanek-otevrit" href="<?php the_permalink(); ?>">Otevřít</a>
       </div>  
       
       <?php if ($pocitadlo_excerptu != get_option('posts_per_page')){
        echo '<div class="hr"></div>';
       }
       
       endwhile;
      ?> 
    
      <div style="clear: both;"></div>     
      <div class="predchozi-aktuality">
       <?php next_posts_link('Starší aktuality'); ?>
      </div>
     
     <?php else : ?>
      </p>
      <div class="clanek">
       <p class="post">
        Nebylo nic nalezeno. Zkuste zadat obecnější výraz.
       </p>
      </div>       
     <?php endif; ?>
     
    </div>
    
   <?php get_sidebar('Pravý sloupec'); ?>   

   </div>
   
   <div id="stranka_konec"></div>

   </div>

   <?php get_footer(); ?>
