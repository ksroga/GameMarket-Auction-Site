    <div class="search-main" style="height:100%;">
	    <div class="container">
	    	<div class="search-box" style="height:auto; width:35rem; background-color:#ffffff; border: 1px solid #ffc107; ">
	    		<h1 class="display-4" style="color:#ffc107;">Zaloguj się</h1>
	    		<div style="margin-top:2rem; border-top: 1px solid #ffc107; padding-top:1rem;">
	    		<?php echo validation_errors(); ?>
	    			<div style="width:80%; margin: 0 auto;">
	    			<?php echo form_open('login'); ?>
		    				<div class="form-group row">
							   <label for="login" class="col-2 col-form-label">Login:</label>
							   <div class="col-10">
							   	<input type="text" class="form-control" id="login" name="login" placeholder="Nazwa użytkownika">
							   	</div>
							 </div>

							 <div class="form-group row">
							  <label for="example-password-input" class="col-2 col-form-label">Hasło:</label>
							  <div class="col-10">
							    <input class="form-control" type="password" value="password" id="password" name="password">
							  </div>
							</div>

							<input class="btn btn-warning" type="submit" value="Zaloguj" style="color:#fff;"><br><br>
							<a href=<?php echo site_url('signup'); ?>>Nie masz jeszcze konta? Zarejestruj się!</a><br>
							<a href="#">Przypomnij hasło</a>
					</form>
		    		</div>
	    		</div>
	    	</div>
	    </div>
	</div>