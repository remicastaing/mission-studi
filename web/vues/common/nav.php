<?php 

$menu = [];


if (isset($_SESSION['admin'])) {
  $menu = [
    ['nom'=> 'Mission', 'link'=>'mission.php'],
    ['nom'=> 'Agents', 'link'=>'agent.php'],
    ['nom'=> 'Cibles', 'link'=>'cible.php'],
    ['nom'=> 'Contacts', 'link'=>'contact.php'],
    ['nom'=> 'Planques', 'link'=>'planque.php'],
  ];

  $connexion = ['nom'=> 'Logout', 'link'=>'logout.php'];
} else {
  $menu = [
    ['nom'=> 'Mission', 'link'=>'mission.php'],
  ];

  $connexion = ['nom'=> 'Login', 'link'=>'login.php'];
}


$explo= explode('/',$_SERVER["SCRIPT_NAME"]);
$script = end($explo);

foreach($menu as &$item){
  $item['active'] = $item['link'] == $script ? "active" : "";
}



?>

<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container container-fluid">
      <a class="navbar-brand" href="#">Mission Studi</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <?php foreach ($menu as $onglet): ?>
              <li class="nav-item">
                <a class="nav-link <?= $onglet['active'] ?>" href="<?= $onglet['link'] ?>"><?= $onglet['nom'] ?></a>
              </li>
              <?php endforeach; ?>
        </ul>
        
        <button class="btn btn-outline-success" onclick="window.location='<?= $connexion['link'] ?>'"><?= $connexion['nom'] ?></button>

      </div>
    </div>
  </nav>
</header>