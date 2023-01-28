       <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?> </a></h2>

       <!-- vypsání příloh zeleně -->
       <?php            
       
        $retezec = '<p class="clanek-prilohy-datum">Přílohy: ';
        $poradi_v_retezci = 0;
       
        //---je v postu embedované video (zvenku)?
        $kupka = get_the_content();
        
        $je_tam_embed_video = false;
     
        $jehla = array('httpv','httpvh','http:\/\/youtu.be','http:\/\/www.youtube.com');
        $jehla = join("|", $jehla);
        $shoda = array();
        if ( preg_match('/' . $jehla . '/i', $kupka, $shoda) ){
         $je_tam_embed_video = true;
        }
        
        //---je v postu embedované video (naše)?
        $kupka = do_shortcode('[attachments doctype=all fields="type" icon="0"]');
        
        $je_tam_nase_video = false;
     
        $jehla = array('video');
        $jehla = join("|", $jehla);
        $shoda = array();
        if ( preg_match('/' . $jehla . '/i', $kupka, $shoda) ){
         $je_tam_nase_video = true;
        }        
        
        //pokud je embedované video, přidat do řetězce
        if (($je_tam_embed_video == true) OR ($je_tam_nase_video == true)) {
         $poradi_v_retezci = $poradi_v_retezci + 1;	
         if ($poradi_v_retezci > 1) {
          $retezec = $retezec . ", ";	 
         }         
         $retezec = $retezec . "video ve znakovém jazyce"; 	
        }

        //---je přiložený dokument?                   
        $je_tam_dokument = false;
     
        $jehla = array('msword','pdf');
        $jehla = join("|", $jehla);
        $shoda = array();
        if ( preg_match('/' . $jehla . '/i', $kupka, $shoda) ){
         $je_tam_dokument = true;
        } 
        
        //pokud je přiložený dokument, přidat do řetězce
        if ($je_tam_dokument == true) {
         $poradi_v_retezci = $poradi_v_retezci + 1;
         if ($poradi_v_retezci > 1) {
          $retezec = $retezec . ", ";	 
         }	 
         $retezec = $retezec . "dokument";  
        }
        
        //---je přiložený obrázek?                   
        $je_tam_obrazek = false;
     
        $jehla = array('image');
        $jehla = join("|", $jehla);
        $shoda = array();
        if ( preg_match('/' . $jehla . '/i', $kupka, $shoda) ){
         $je_tam_obrazek = true;
        } 
        
        //pokud je přiložený obrázek, přidat do řetězce
        if ($je_tam_obrazek == true) {
         $poradi_v_retezci = $poradi_v_retezci + 1;
         if ($poradi_v_retezci > 1) {
          $retezec = $retezec . ", ";	 
         }	 
         $retezec = $retezec . "obrázek";  
        } 
        
        //---je přiložená tabulka?                   
        $je_tam_tabulka = false;
     
        $jehla = array('excel');
        $jehla = join("|", $jehla);
        $shoda = array();
        if ( preg_match('/' . $jehla . '/i', $kupka, $shoda) ){
         $je_tam_tabulka = true;
        } 
        
        //pokud je přiložená tabulka, přidat do řetězce
        if ($je_tam_tabulka == true) {
         $poradi_v_retezci = $poradi_v_retezci + 1;
         if ($poradi_v_retezci > 1) {
          $retezec = $retezec . ", ";	 
         }	 
         $retezec = $retezec . "tabulka";  
        } 

        //---je přiložená prezentace?                   
        $je_tam_prezentace = false;
     
        $jehla = array('powerpoint');
        $jehla = join("|", $jehla);
        $shoda = array();
        if ( preg_match('/' . $jehla . '/i', $kupka, $shoda) ){
         $je_tam_prezentace = true;
        } 
        
        //pokud je přiložená tabulka, přidat do řetězce
        if ($je_tam_prezentace == true) {
         $poradi_v_retezci = $poradi_v_retezci + 1;
         if ($poradi_v_retezci > 1) {
          $retezec = $retezec . ", ";	 
         }	 
         $retezec = $retezec . "prezentace";  
        }             
 
        //pokud je příloh moc, odřádkovat
        if ($poradi_v_retezci >= 4) {
         $retezec = $retezec . "<br />";;
        } else {
         $retezec = $retezec . " • ";
        } 
        
        //pokud nejsou žádné přílohy, úplně to vyhodit
        if ($poradi_v_retezci == 0) {
         $retezec = '<p class="clanek-prilohy-datum">';
        }        
        
        $retezec = $retezec . "Vydáno ";
        
        echo $retezec;        
        the_time('j. n. Y');       
        echo "</p>";
        
       ?> 
       
       <!-- ikony příloh -->
       <?php 
        //IKONA VIDEA - pokud je tam video, zobrazit ikonu videa v ZJ
        if (($je_tam_embed_video == true) OR ($je_tam_nase_video == true)) {
         ?><a href="<?php the_permalink(); ?>"><img class="ikona_post" alt="Příloha: video ve znakovém jazyce" src="<?php bloginfo("template_url"); ?>/img/ikona_h-video.png" /></a><?php	
        }	
       ?>    

       <?php
        //IKONY PŘÍLOH kromě videa (jestliže jsou přílohy)
        if ($seznam_priloh !== "") {
         $vykreslene_ikony = do_shortcode('[attachments doctype=all fields="0" size=custom]');
         
         //pokud je tam flv, vyhodit tuto ikonu
         if ($je_tam_nase_video == true) {
          $rozsekano = explode(">","$vykreslene_ikony");  
          $vykreslene_ikony = "";           
          for($i=0;$i<count($rozsekano);$i++){
           //oprava explodovaného řetězce  
           $rozsekano[$i] = $rozsekano[$i] . ">";
           if ($rozsekano[$i] == ">"){
            $rozsekano[$i] = "";	    
           }
           $pozice_substringu = strpos($rozsekano[$i],'flv');
           if($pozice_substringu === false) {
            //není to flv
           } else {
            //je to flv
            $rozsekano[$i] = "";
           } 
          }
          for($i=0;$i<count($rozsekano);$i++){
           $vykreslene_ikony = $vykreslene_ikony . $rozsekano[$i];
          } 
         } 
         
         //pokud je tam víc obrázků jpg, odstranit duplicitní ikony         
         $opakovani_obrazku = substr_count($vykreslene_ikony, 'jpg');
         if ($opakovani_obrazku>1) {
          $rozsekano = explode(">","$vykreslene_ikony");         
          $vykreslene_ikony = "";         
          $poradi_obrazku = 0;         
          for($i=0;$i<count($rozsekano);$i++){
           //oprava explodovaného řetězce  
           $rozsekano[$i] = $rozsekano[$i] . ">";
           if ($rozsekano[$i] == ">"){
             $rozsekano[$i] = "";	    
           }          
           $pozice_substringu = strpos($rozsekano[$i],'jpg');
           if($pozice_substringu === false) {
            //není to jpg
            } else {
            //je to jpg
            $poradi_obrazku = $poradi_obrazku + 1;
            //jestliže to není první obrázek
            if ($poradi_obrazku>1){
             $rozsekano[$i-1] = "";	    
             $rozsekano[$i] = "";
             $rozsekano[$i+1] = "";
            }  
           }          
          }          
          for($i=0;$i<count($rozsekano);$i++){
           $vykreslene_ikony = $vykreslene_ikony . $rozsekano[$i];
          }
         }	         	 
         
         $vykreslene_ikony = str_replace('width="48" height="48"', '', $vykreslene_ikony);    
         $vykreslene_ikony = str_replace('<img', '<img class="ikona_post"', $vykreslene_ikony);  
         echo $vykreslene_ikony;     
  	} 
       ?>
