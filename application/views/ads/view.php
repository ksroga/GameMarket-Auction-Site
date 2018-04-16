	<div class="view">
		<div class="container">
			<div class="vcontent">
				<div class="vinf">
					<div class="ism-slider" data-transition_type="fade" data-play_type="once" id="my-slider">
					  <ol>
					    <?php
					    	if(!empty($images)) {
					    		foreach($images as $img) {
					    			echo '<li>';
					    			echo '<img src='.asset_url().'uploads/offers/'.$ad->id.'/'.$img.' >';
					    			echo '</li>';
					    		}
					    	} else {
					    		echo '<li>';
					    		echo '<img src='.asset_url().'img/nofoto.png >';
					    		echo '</li>';
					    	}
					    ?>
					  </ol>
					</div>
					<div class="title"><?php echo $ad->title; ?></div>
					<div class="date">Dodane <?php echo $created; ?></div>
					<div class="platform"><span data-toggle="popover" data-trigger="hover" title="" data-content="Typ i platforma dla sprzedawanego przedmiotu." data-original-title="Typ sprzedawanego przedmiotu"><?php echo '<img src='.asset_url().$ad->typeIcon.'> '.$ad->type.' <img src='.asset_url().$ad->platformIcon.'> '.$ad->platform; ?> </span></div>
					<hr>
					<div class="description"><?php echo $ad->description ?></div>
					<div class="opt">Zgłoś naruszenie</div>
				</div>
				<div class="vbox">
					<div class="price">
						<?php echo $ad->price.' zł'; ?>
						<div class="opt"><?php echo ($ad->negotiation == 1 ? 'Do negocjacji' : ''); ?></div>
						<div class="opt"><?php echo ($ad->exchange == 1 ? 'Możliwa zamiana' : ''); ?></div>
					</div>
					<div class="msg"><i class="fa fa-envelope" aria-hidden="true"></i> Napisz wiadomość</div>
					<div class="profile">
						<img src=<?php echo asset_url().'img/user.png'; ?>> 
						<div class="name"><?php echo ($author['first_name'] ? $author['first_name'] : $author['login']);  ?></div>
						<div class="opt">W serwisie od <?php echo gmdate('d/m/y', $author['created']); ?></div>
						<div class="opt">Ostatnio widziany <?php echo gmdate('d/m/y', $author['last_logon']); ?></div>
						<div class="status"><?php echo ($authorStatus ? '<span class="badge badge-pill badge-success">Online</span>' : '<span class="badge badge-pill badge-danger">Offline</span>');  ?></div>
					</div>
				</div>
				<div class="vcontent">
					<div class="vinf ads">
						<div class="boxtitle">Inne Ogłoszenia</div>
						<?php
						foreach($authorAds as $index => $otherAd) {
							if($otherAd->id == $ad->id || $index > 3)
								continue;
							echo '<div class="ad">';
							echo '<div class="adphoto"><img src='.$otherAd->image.' /></div>';
							echo '<div class="content">';
							echo '<div class="title"><a href='.site_url("ad/view/".$otherAd->id).'>'.$otherAd->title.'</a></div>';
							echo '<div class="category">Platforma: '.$otherAd->platform.'</div>';
							echo '<div class="type">'.$otherAd->type.'</div>';
							echo '<div class="date">';
							echo $otherAd->created;
							echo '</div></div>';
							echo '<div class="right">';
							echo '<div class="price">'.$otherAd->price.' zł</div>';
							echo '<div class="opt">';
							if($otherAd->negotiation == 1)
								echo 'Do negocjacji<br>';
							if($otherAd->exchange == 1)
								echo 'Możliwość zamiany<br>';
							echo '</div></div></div>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

