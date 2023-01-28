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
     <?php wp_list_categories('depth=1&title_li=&hide_empty=0'); ?> <!-- CURRENTY: current-menu_prvni, current-menu, current-menu_posledni -->
    </ul>    
   </div>
   
   <!-- submenu -->

   <div id="submenu">
    <ul>
     <?php
      $kategorie_sub = get_the_category();
      $kategorie_ted = $kategorie_sub[0]->term_id;
      $nadrazena_kategorie_ted = $kategorie_sub[0]->parent;      
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
       
      <div class="clanek">
       <div> 
        <?php include("vypsat_prilohy.php"); ?>
        <!-- excerpt -->
        <?php the_excerpt(); ?>
       </div>
       <div id="single_po_excerptu">
       <?php the_content(); ?>
      </div>
       
       <?php
        //SEZNAM PŘÍLOH automaticky (jestliže jsme v kategorii Aktuality a u postu jsou přílohy)
        $seznam_priloh = do_shortcode('[attachments doctype=all fields="title,description,filename,size"]');
        if (($nadrazena_kategorie_ted == "4") AND !($seznam_priloh == "")) {
         ?><h3>Přílohy</h3><div id="prilohy_pod_clankem"><?php	
          $seznam_priloh = str_replace('width="48" height="48"', '', $seznam_priloh);
          $seznam_priloh = str_replace('Title', 'Příloha', $seznam_priloh); 
          $seznam_priloh = str_replace('Caption', 'Popis', $seznam_priloh);
          $seznam_priloh = str_replace('Description', 'Popis', $seznam_priloh); 
          $seznam_priloh = str_replace(' :', ':', $seznam_priloh); 
          echo $seznam_priloh;
       	 ?></div><?php
       	}
       ?>
       
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
   
   
