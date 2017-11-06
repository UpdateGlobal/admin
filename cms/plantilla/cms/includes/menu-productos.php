				<select id="qn">
					<option <?php echo ($page == "productoscategorias" ? "selected" : "")?> value="productos-categorias.php">Categor&iacute;as</option>
					<option <?php echo ($page == "productossubcategorias" ? "selected" : "")?> value="productos-subcategorias.php">Sub-categor&iacute;a</option>
					<option <?php echo ($page == "productos" ? "selected" : "")?> value="productos.php">Productos</option>
					<option <?php echo ($page == "productosgaleria" ? "selected" : "")?> value="productos-galeria.php">Fotos</option>
					<option <?php echo ($page == "pedidos" ? "selected" : "")?> value="pedidos.php">Pedidos</option>
				</select>
				<!-- /DropDown Responsive -->
				<div class="quick-nav">
					<ul>
						<li class="qn-first <?php echo ($page == "productoscategorias" ? "active" : "")?>"><a href="productos-categorias.php"><i class="fa fa-window-maximize"></i> Categor&iacute;as</a></li>
						<li class="<?php echo ($page == "productossubcategorias" ? "active" : "")?>"><a href="productos-subcategorias.php"><i class="fa fa-window-restore"></i> Sub-categor&iacute;a</a></li>
						<li class="<?php echo ($page == "productos" ? "active" : "")?>"><a href="productos.php"><i class="fa fa-cube"></i> Productos</a></li>
						<li class="<?php echo ($page == "productosgaleria" ? "active" : "")?>"><a href="productos-galeria.php"><i class="fa fa-picture-o"></i> Fotos</a></li>
						<li class="<?php echo ($page == "pedidos" ? "active" : "")?>"><a href="pedidos.php"><i class="fa fa-shopping-cart"></i> Pedidos</a></li>
					</ul>
				</div>