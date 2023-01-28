    <!-- widgety vpravo -->
    <ul id="sidebar">
    
    <?php
     if(!function_exists('dynamic_sidebar')
     || !dynamic_sidebar('Pravý sloupec')) :
    ?>
     <p>Neumístili jste sem žádné widgety. Toto hlášení vygeneroval soubor asneptheme/sidebar.php.</p>
    <?php endif; ?>	    
    
   </ul>
