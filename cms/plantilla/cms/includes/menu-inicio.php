				<select id="qn">
					<option <?php echo ($page == "metatags" ? "selected" : "")?> value="inicio.php">Metatags</option>
					<option <?php echo ($page == "banners" ? "selected" : "")?> value="banners.php">Banners</option>
					<option <?php echo ($page == "carrusel" ? "selected" : "")?> value="carrusel.php">Carrusel</option>
				</select>
				<!-- /DropDown Responsive -->
				<div class="quick-nav">
					<ul>
						<li class="qn-first <?php echo ($page == "metatags" ? "active" : "")?>"><a href="inicio.php"><i class="fa fa-file-text-o"></i> Metatags</a></li>
						<li class="<?php echo ($page == "banners" ? "active" : "")?>"><a href="banners.php"><i class="fa fa-picture-o"></i> Banners</a></li>
						<li class="<?php echo ($page == "carrusel" ? "active" : "")?>"><a href="carrusel.php"><i class="fa fa-tags"></i> Carrusel</a></li>
					</ul>
				</div>