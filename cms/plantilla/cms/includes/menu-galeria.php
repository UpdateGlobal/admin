				<select id="qn">
					<option <?php echo ($page == "galerias" ? "selected" : "")?> value="galerias.php">Albums</option>
					<option <?php echo ($page == "galeriasalbums" ? "selected" : "")?> value="galerias-albums.php">Fotos</option>
					<option <?php echo ($page == "videos" ? "selected" : "")?> value="videos.php">V&iacute;deos</option>
				</select>
				<!-- /DropDown Responsive -->
				<div class="quick-nav">
					<ul>
						<li class="qn-first <?php echo ($page == "galerias" ? "active" : "")?>"><a href="galerias.php"><i class="fa fa-calendar"></i> Albums</a></li>
						<li class="<?php echo ($page == "galeriasalbums" ? "active" : "")?>"><a href="galerias-albums.php"><i class="fa fa-picture-o"></i> Fotos</a></li>
						<li class="<?php echo ($page == "videos" ? "active" : "")?>"><a href="videos.php"><i class="fa fa-video-camera"></i> V&iacute;deos</a></li>
					</ul>
				</div>