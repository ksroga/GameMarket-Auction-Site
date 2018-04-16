    <div class="search-main" style="height:100%;">
	    <div class="container">
	    	<div class="search-box" style="height:auto; width:35rem; background:#DFF2BF; border: 1px solid #4F8A10; ">
	    		<h1 class="display-4" style="color:#4F8A10;">Dodałeś ogłoszenie!</h1>
	    		<div style="margin-top:2rem; border-top: 1px solid #DFF2BF; padding-top:1rem;">
	    			<div style="width:80%; margin: 0 auto;">
		    			Pomyślnie dodałeś ogłoszenie <strong><a href=<?php echo site_url('ad/view/'.$adv).'>'.$post['title']; ?>.</a></strong>
		    			<div style="margin-top:1rem;">
		    				<?php echo anchor('profile/ads', 'Moje Ogłoszenia'); ?><br>
							<?php echo anchor('start', 'Powrót na Stronę Główną'); ?>
						</div>
		    		</div>
	    		</div>
	    	</div>
	    </div>
	</div>