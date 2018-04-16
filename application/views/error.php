    <div class="search-main" style="height:100%;">
	    <div class="container">
	    	<div class="search-box" style="height:auto; width:35rem; background-color:#ffffff; border: 1px solid #cc0000; ">
	    		<h1 class="display-4" style="color:#cc0000;">Wystąpił błąd!</h1>
	    		<div style="margin-top:2rem; border-top: 1px solid #cc0000; padding-top:1rem;">
	    			<div style="width:80%; margin: 0 auto;">
		    			<?php echo $error; ?>
		    			<div style="margin-top:1rem;">
							<a href="javascript: history.back()">Powrót do poprzedniej strony</a><br>
							<a href=<?php echo site_url('start'); ?>>Powrót na Stronę Główną</a>
						</div>
		    		</div>
	    		</div>
	    	</div>
	    </div>
	</div>