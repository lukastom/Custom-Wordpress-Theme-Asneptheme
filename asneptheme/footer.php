  <div id="footer">

   <!-- mezera nad footerem -->
   <div class="footer-mezera"></div>

   <!-- horní část footeru -->
   <div id="footer-horni"></div>

   <!-- střední část footeru - dolní widgety -->
   <div id="footer-stred">

    <?php
     if(!function_exists('dynamic_sidebar')
     || !dynamic_sidebar('Spodní část vlevo')) :
    ?>
     <p>Neumístili jste sem žádné widgety. Toto hlášení vygeneroval soubor asneptheme/footer.php.</p>
    <?php endif; ?>
   
    <?php
     if(!function_exists('dynamic_sidebar')
     || !dynamic_sidebar('Spodní část uprostřed')) :
    ?>
     <p>Neumístili jste sem žádné widgety. Toto hlášení vygeneroval soubor asneptheme/footer.php.</p>
    <?php endif; ?>   
   
    <?php
     if(!function_exists('dynamic_sidebar')
     || !dynamic_sidebar('Spodní část vpravo')) :
    ?>
     <p>Neumístili jste sem žádné widgety. Toto hlášení vygeneroval soubor asneptheme/footer.php.</p>
    <?php endif; ?>   

   </div>
  
   <!-- dolní část footeru -->
   <div id="footer-dolni"></div>  
   
   <!-- copyright -->
   <div id="footer-copyright">
    <p>© 2004-2011 ASNEP, Design © 2011 Lukáš Tomek, Všechna práva vyhrazena</p>
    <?php wp_footer(); ?>
   </div> 
  
  </div>

 </div>

 </body>
</html>
