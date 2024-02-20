 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="img/Escudo.png" alt="Zarcam" class="" style="background: #fff; width:100%; "><br>
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style=" padding-bottom:0px !Important;">
        <div class="info" style="color:#fff; margin:0 auto;">

		<div style="text-align:center;">
			<small>
				<em>
					<strong>
						<a href="CerrarSesion.php" >
							[ cerrar sesi&oacute;n ]
						</a>
					</strong>
				</em>
			</small>
		</div>	
<BR>		
        </div>
      </div>

      <?php if($_SESSION['tipo_usuario'] == 'Admin') { ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<!--<li class="nav-item">
					<a href="CrearUsuarios.php" class="nav-link">
					<i class="nav-icon fa fa-user-plus"></i>
					<p>
					CREAR PACIENTES
					</p>
					</a>
				</li>-->
				<li class="nav-item">
					<a href="Partidos.php" class="nav-link">
					<img src="img/Partidos.png" style="width:30px; color:#000;" />
					<p>
					PARTIDOS 
					</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="Jugadores.php" class="nav-link">
					<img src="img/Jugador.png" style="width:30px; color:#000;" />
					<p>
					JUGADORES 
					</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="Categorias.php" class="nav-link">
					<img src="img/Categorias.png" style="width:30px; color:#000;" />
					<p>
					CATEGORIAS 
					</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="Divisiones.php" class="nav-link">
					<img src="img/Divisiones.png" style="width:30px; color:#000;" />
					<p>
					DIVISIONES 
					</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="Campeonatos.php" class="nav-link">
					<img src="img/Campeonatos.png" style="width:30px; color:#000;" />
					<p>
					CAMPEONATOS 
					</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="Rivales.php" class="nav-link">
					<img src="img/Rivales.png" style="width:30px; color:#000;" />
					<p>
					RIVALES 
					</p>
					</a>
				</li>
		</ul>
      </nav>
	  <?php } ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

