</head>
<body background="batik.jpg">

<nav class="navbar navbar-expand-sm bg-danger navbar-dark sticky-top">
    <div class="container">
   
    <img src="telkom.png" alt="logo" style="width:70px;">
     </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <form class="form-inline" action="search.php" method="get">
          
          <input class="form-control mr-sm-1" name="nyari" type="text" placeholder="Cari Data">
           </form>
           
          </li>
          <li class="nav-item ">
          <a class="nav-link text-white" href="list_data.php"><i class="fas fa-home" style="font-size:13px;color:white"></i> Halaman Utama</a>
          </li>
          <li class="nav-item">
          <a class="nav-link text-white" href="tambah_data.php"> <i class="fas fa-folder-plus" style="font-size:13px;color:white"></i> Tambah Data</a>
          </li>
          
          <li class="nav-item">
          <a class="nav-link text-white" href="action.php?action=logout"> <i class="fas fa-sign-out-alt" style="font-size:13px;color:white"></i> Keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>