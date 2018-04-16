    <div class="search-main" style="height:100%;">
	    <div class="container">
	    	<div class="search-box" style="height:auto; width:35rem; background-color:#ffffff; border: 1px solid #ffc107; padding-bottom:2rem;">
	    		<h1 class="display-4" style="color:#ffc107;">Rejestracja</h1>
	    		<div style="margin-top:2rem; border-top: 1px solid #ffc107; padding-top:1rem;">
	    		<?php echo validation_errors(); ?>
	    			<div style="width:80%; margin: 0 auto;">
	    			<?php echo form_open('signup'); ?>
		    				<div class="form-group row <?= form_error('login') ? 'text-danger' : '' ?>">
							   <label for="login" class="col-2 col-form-label">Login:</label>
							   <div class="col-10">
							   	<input type="text" class="form-control <?= form_error('login') ? 'is-invalid' : '' ?>" id="login" name="login" placeholder="Nazwa użytkownika">
							   	</div>
							 </div>

							 <div class="form-group row <?= form_error('password') ? 'text-danger' : '' ?>">
							  <label for="example-password-input" class="col-2 col-form-label">Hasło:</label>
							  <div class="col-10">
							    <input class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" type="password" placeholder="••••••" id="password" name="password">
							  </div>
							  <small id="passwordHelpInline" class="text-muted" style="padding-left:6rem;">
      							Hasło musi mieć minimum 6 znaków.<br>
    						  </small>
							</div>

							 <div class="form-group row <?= form_error('password2') ? 'text-danger' : '' ?>">
							  <label for="example-password-input" class="col-2 col-form-label">Powtórz hasło:</label>
							  <div class="col-10">
							    <input class="form-control <?= form_error('password2') ? 'is-invalid' : '' ?>" type="password" placeholder="••••••" id="password2" name="password2" style="margin-top:0.8rem;">
							  </div>
							</div>

							<div class="form-group row <?= form_error('email') ? 'text-danger' : '' ?>">
							  <label for="example-password-input" class="col-2 col-form-label">E-Mail:</label>
							  <div class="col-10">
							    <input class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" type="email" placeholder="JanKowalski@example.com" id="email" name="email">
							  </div>
							</div>

							<div class="form-check form-group <?= form_error('rules') ? 'text-danger' : '' ?>">
							  <label class="form-check-label">
							    <input class="form-check-input" type="checkbox" id="rules" name="rules" value="rules"> <small>Oświadczam, że zapoznałem się i akceptuję Regulamin serwisu GameMarket.pl</small>
							  </label>
							</div>

							<input class="btn btn-warning" type="submit" value="Zarejestruj się" style="color:#fff;"><br><br>
							<a href=<?php echo site_url('login'); ?>>Posiadasz już konto? Zaloguj się!</a><br>
					</form>
		    		</div>
	    		</div>
	    	</div>
	    </div>
	</div>