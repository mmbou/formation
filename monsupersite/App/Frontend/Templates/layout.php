<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Mon super site' ?>
    </title>
    
    <meta charset="utf-8" />
    
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
                  
           <?php if ($user->isAuthenticated() == false) { ?>
           <li><a href="/admin/">Connection</a></li>
          <?php } ?>

          <?php if ($user->isAuthenticated() AND $user->getAttribute('type') == 1) { ?> 
          <li><a href="/admin/">Admin</a></li>
          <li><a href="/admin/news-insert.html">Add news</a></li>
          <li><a href="/admin/user-insert.html">Add user</a></li>
          <li><a href="/admin/user-index.html">See users</a></li>
          <li><a href="/admin/logout">Logout</a></li>
          <?php } ?>


           <?php if ($user->isAuthenticated() AND $user->getAttribute('type') == 0) { ?>
          <li><a href="/admin/news-insert.html">Add news</a></li>
          <li><a href="/admin/logout">Logout</a></li>
          <?php } ?>

          <li><a href="/device/">See device</a></li>
         
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