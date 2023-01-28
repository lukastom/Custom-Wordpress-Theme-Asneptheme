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
   <div id="menu" style="height: 37px;">
    <ul>     
     <?php wp_list_categories('depth=1&title_li=&hide_empty=0'); ?>
    </ul>    
   </div>
   
   <!-- submenu -->

   <div id="submenu">
    <ul>
     <?php
      $kategorie_sub = get_the_category();
      if (!empty($kategorie_sub)){
       //$kategorie_ted = $kategorie_sub[0]->term_id;
       $nadrazena_kategorie_ted = $kategorie_sub[0]->parent;      
       wp_list_categories('child_of=' . $nadrazena_kategorie_ted . '&title_li=&hide_empty=0');
      } else if (empty($kategorie_sub)){
       $current_url = rtrim($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], "/");
       $arr_current_url = split("/", $current_url);
       $thecategory = get_category_by_slug(end($arr_current_url));
       //$kategorie_ted = $thecategory->term_id;
       $nadrazena_kategorie_ted = $thecategory->parent;
       wp_list_categories('child_of=' . $nadrazena_kategorie_ted . '&title_li=&hide_empty=0');
      }
     ?>
    </ul>    
   </div>     

   <div id="main">

    <div id="menu_stin"></div>
   
    <div id="wrap_sloupcu">
    
     <!-- posty -->
     <div id="levy_sloupec">
     
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
        
      <div class="novejsi-aktuality">  
       <?php previous_posts_link('Novější aktuality'); ?>
      </div>
     
     <?php else : ?>
      </p>
      <div class="clanek">
       <p class="post">
        V této rubrice v tuto chvíli nejsou žádné články.
       </p>
      </div> 
     <?php endif; ?>
     
    </div>
    
   <?php get_sidebar('Pravý sloupec'); ?>   

   </div>
   
   <div id="stranka_konec"></div>

   </div>

   <?php get_footer(); ?>
