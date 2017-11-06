				<select id="qn">
					<option <?php echo ($page == "portafoliocategorias" ? "selected" : "")?> value="portafolio-categorias.php">Categor&iacute;as</option>
					<option <?php echo ($page == "portafolio" ? "selected" : "")?> value="portafolio.php">Trabajos</option>
					<option <?php echo ($page == "portafoliogalerias" ? "selected" : "")?> value="portafolio-galerias.php">Fotos Trabajos</option>
				</select>
				<!-- /DropDown Responsive -->
				<div class="quick-nav">
					<ul>
						<li class="qn-first <?php echo ($page == "portafoliocategorias" ? "active" : "")?>"><a href="portafolio-categorias.php"><i class="fa fa-window-restore"></i> Categor&iacute;as</a></li>
						<li class="<?php echo ($page == "portafolio" ? "active" : "")?>"><a href="portafolio.php"><i class="fa fa-folder-open"></i> Trabajos</a></li>
						<li class="<?php echo ($page == "portafoliogalerias" ? "active" : "")?>"><a href="portafolio-galerias.php"><i class="fa fa-picture-o"></i> Fotos Trabajos</a></li>
					</ul>
				</div>