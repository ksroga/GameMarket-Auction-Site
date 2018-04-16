    <div class="search-main">
	    <div class="container">
	    	<div class="search-box">
	    		<div class="search-form">
		    		<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1" style="background:white;"><i class="fa fa-search" aria-hidden="true"></i></span>
					  <input type="text" class="form-control" placeholder="Szukaj" aria-describedby="basic-addon1">
					</div>
				</div>
				<div class="search-platform">
					<select class="custom-select">
					  <option selected>Wybierz Platformę</option>
					  <?php
	    				foreach($categories as $category) {
	    					echo '<option value='.$category['category'].'>'.$category['category'].'</option>';
	    				}
	    			  ?>
					</select>
				</div>
				<div class="search-button">
				<button type="button" class="btn btn-warning" style="background-color:#ffffff; color:#000000;"><i class="fa fa-search" aria-hidden="true"></i> Szukaj</button>
				</div>
	    	</div>
	    	<div class="categories-box">
	    		<div class="categories">
	    			<div class="title">Platformy</div>
	    			<ul>
	    				<?php
	    				foreach($categories as $category) {
	    					echo '<li><img src='.asset_url().$category['icon'].'> '.$category['category'].'</li>';
	    				}
	    				?>
	    			</ul>
	    		</div>
	    	</div>
	    	<div>
	    	</div>
	    </div>
	</div>
	<div class="adsmain">
		<div class="container">
			<div class="box">
				<div id="boxtitle">Najnowsze Ogłoszenia</div>
				<?php
				foreach($ads as $ad) {
					echo '<div class="ad">';
					echo '<div class="adphoto"><img src='.$ad->image.' /></div>';
					echo '<div class="content">';
					echo '<div class="title"><a href='.site_url("ad/view/".$ad->id).'>'.$ad->title.'</a></div>';
					echo '<div class="category">Platforma: '.$ad->platform.'</div>';
					echo '<div class="type">'.$ad->type.'</div>';
					echo '<div class="date">';
					echo $ad->created;
					echo '</div></div>';
					echo '<div class="right">';
					echo '<div class="price">'.$ad->price.' zł</div>';
					echo '<div class="opt">';
					if($ad->negotiation == 1)
						echo 'Do negocjacji<br>';
					if($ad->exchange == 1)
						echo 'Możliwość zamiany<br>';
					echo '</div></div></div>';
				}

				?>
			</div>
		</div>
	</div>

