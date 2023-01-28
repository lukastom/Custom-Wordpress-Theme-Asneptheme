<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
 <head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> 
  <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
  <link rel="pingback" href="<?php bloginfo('pingback url'); ?>" /> 
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" /> 
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico" /> 
  <?php wp_head(); ?>
 </head>

 <body>

  <div id="wrap">

   <div id="header">

    <!-- logo -->
    <h1><a href="<?php bloginfo('url'); ?>">Logo ASNEP</a></h1>

    <!-- menu - stránky --> 
    <div id="stranky">

     <ul>
      <li class="stranka_prvni"><a href="<?php bloginfo('url'); ?>">Úvod</a></li>
      <?php wp_list_pages('title_li='); ?>
     </ul> 

    </div>
