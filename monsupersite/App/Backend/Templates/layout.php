<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Mon super site' ?>
    </title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link rel="stylesheet" href="/css/Envision.css" type="text/css" />
  
  </head>
  
  <body>
    <div id="wrap">
      <header>
        <h1><a href="/">Mon super site</a></h1>
        <p>Comment ça, il n'y a presque rien ?</p>
      </header>
      
      <nav>
        <ul>
          <li><a href="/">Accueil</a></li>

          <?php if ($user->isAuthenticated() AND $user->getAttribute('type') == 1) { ?> 
          <li><a href="/admin/news-insert.html">Add news</a></li>
          <li><a href="/admin/">Edit news</a></li>
          <li><a href="/admin/user-insert.html">Add user</a></li>
          <li><a href="/admin/user-index.html">Edit users</a></li>
          <li><a href="/admin/logout">Logout</a></li>
          <?php } ?>


           <?php if ($user->isAuthenticated() AND $user->getAttribute('type') == 2) { ?>
          <li><a href="/admin/news-insert.html">Add news</a></li>
          <li><a href="/admin/">Edit news</a></li>
          <li><a href="/admin/logout">Logout</a></li>
          <?php } ?>

   

        </ul>
      </nav>
      
      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
          
          <?= $content ?>
        </section>
      </div>
    
      <footer></footer>
    </div>
  </body>
</html>