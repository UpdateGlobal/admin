				<select id="qn">
					<option <?php echo ($page == "servicios" ? "selected" : "")?> value="servicios.php">Servicios</option>
					<option <?php echo ($page == "serviciosfotos" ? "selected" : "")?> value="servicios-fotos.php">Fotos</option>
				</select>
				<!-- /DropDown Responsive -->
				<div class="quick-nav">
					<ul>
						<li class="qn-first <?php echo ($page == "servicios" ? "active" : "")?>"><a href="servicios.php"><i class="fa fa-tasks"></i> Servicios</a></li>
						<li class="<?php echo ($page == "serviciosfotos" ? "active" : "")?>"><a href="servicios-fotos.php"><i class="fa fa-picture-o"></i> Fotos</a></li>
					</ul>
				</div>