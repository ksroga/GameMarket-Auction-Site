<div class="container add">
	<?php echo form_open_multipart(); echo validation_errors(); ?>
	<div class="title">Zaczynamy!</div>
	<div class="box">
		<div>
			<div class="label">Tytuł<span style="color:red;">*</span></div>
			<div class="input">
				<div class="form-group">
				    <input type="text" class="form-control <?= form_error('title') ? 'is-invalid' : '' ?>" id="title" name="title" placeholder="Tytuł Twojego ogłoszenia" data-toggle="popover" data-trigger="focus" title="Tytuł Twojego ogłoszenia" data-content="Prosimy - nie pisz WIELKIMI LITERAMI" maxlength="70">
				    <small id="titleStatus" class="form-text text-muted"><span id="charLeft">70</span> znaków pozostało</small>
			  	</div>
		  	</div>
	  	</div>

	  	<div>
		  	<div class="label">Wybierz platformę<span style="color:red;">*</span></div>
		  	<div class="input">
		  		<select class="custom-select <?= form_error('platform') ? 'is-invalid' : '' ?>" name="platform" onchange="">
					<option selected value="">Wybierz platformę</option>
					<?php
		    			foreach($categories as $category) {
		    				echo '<option value='.$category['id'].'>'.$category['category'].'</option>';
		    			}
		    		?>
				</select>
		  	</div>
		 </div>

		<div style="margin-top:1rem;">
	  			<div class="label">Wybierz typ<span style="color:red;">*</span></div>
	  			<div class="input">
	  				<select class="custom-select <?= form_error('type') ? 'is-invalid' : '' ?>" name="type" data-toggle="popover" data-trigger="focus" title="Typ sprzedawanego przedmiotu" data-content="Wybierz typ wystawianego na ogłoszenie przedmiotu.">
	  					<option selected value="">Wybierz typ przedmiotu</option>
	  					<?php
			    			foreach($types as $type) {
			    				echo '<option value='.$type['id'].'>'.$type['type'].'</option>';
			    			}
		    			?>
	  				</select>					
	  			</div>
	  	</div>
	</div>

	<div class="box">
		<div>
			<div class="label">Opis<span style="color:red;">*</span></div>
			<div class="input">
				<div class="form-group">
				    <textarea class="form-control <?= form_error('desc') ? 'is-invalid' : '' ?>" id="desc" name="desc" rows="6" maxlength="2000"></textarea>
				     <small id="descStatus" class="form-text text-muted"><span id="charLeftdesc">2000</span> znaków pozostało</small>
				 </div>
			</div>
		</div>

		<div class="label"><i class="fa fa-camera" aria-hidden="true"></i> Dodaj zdjęcia</div>
		<div class="input">
			<input type="file" name="images[]" id="images" size="20" multiple />
			<small class="form-text text-muted">Zdjęcie główne będzie wyświetlane podczas wyszukiwania przy Twoim ogłoszeniu.</small>
			<div id="preview"></div>
			<small id="previewText" class="form-text text-muted">Naciśnij, aby zaznaczyć zdjęcie główne.</small>
			<input type="hidden" id="selectedImg" name="selectedImg" value="">
		</div>

		<div style="margin-top:0.5rem; min-width:15rem;">
			<div class="label">Cena</div>
			<div class="input">
				<div class="input-group mb-2 mr-sm-2 mb-sm-0" style="width:30%;">
			   	 	<input type="number" class="form-control <?= form_error('price') ? 'is-invalid' : '' ?>" id="price" name="price" placeholder="50" max="10000" min="0">
			    	<div class="input-group-addon">zł</div>
			  	</div>
			  	<div style="padding-top:1rem; width:30%;" >
				  	<label class="custom-control custom-checkbox">
					  <input type="checkbox" class="custom-control-input" id="negotiation" name="negotiation">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">Do negocjacji</span>
					</label>
				</div>
				<div style="padding-top:1rem; width:38%;" >
				  	<label class="custom-control custom-checkbox">
					  <input type="checkbox" class="custom-control-input" id="exchange" name="exchange">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">Możliwość zamiany</span>
					</label>
				</div>
			</div>
		</div>

	</div>

	<div class="title">Dane kontaktowe</div>
	<div class="box">
		<div>
			<div class="label">Twoje imię</div>
			<div class="input" style="width:40%">
				<div class="form-group">
				    <input type="text" class="form-control" id="firstname" name="firstname" data-toggle="popover" data-trigger="focus" title="Twoje imię" data-content="Jeśli wypełnisz to pole zamiast Twojego nicku wyświetlać się będzie Twoje imię. Opcję tę możesz zmienić w ustawieniach." maxlength="70" <?php if(!empty($profile['first_name'])) echo 'readonly placeholder='.$profile["first_name"]; ?>>
				    <small class="form-text text-muted">Opcjonalne</small>
			  	</div>
		  	</div>
		</div>
		<div>
			<div class="label">Adres E-Mail</div>
			<div class="input" style="width:40%">
				<div class="form-group">
				    <input type="email" class="form-control" id="email" name="email"maxlength="128" placeholder="<?php echo $profile['email']; ?>" disabled>
				    <small class="form-text text-muted">Twój adres E-Mail będzie widoczny tylko dla Ciebie.</small>
			  	</div>
		  	</div>
		</div>
		<div>
			<div class="label"><i class="fa fa-mobile" aria-hidden="true"></i> Numer telefonu</div>
			<div class="input" style="width:40%">
				<div class="form-group">
				    <input type="text" class="form-control" id="phone" name="phone" maxlength="12" data-toggle="popover" data-trigger="focus" title="Numer telefonu" data-content="Niektórzy użytkownicy wolą kontaktować się przez telefon, niż pisać wiadomości." maxlength="70">
				    <small class="form-text text-muted">Opcjonalne</small>
			  	</div>
		  	</div>
		</div>
		<div class="label"></div>
		<div class="input">
			<input class="form-check-input" type="checkbox" id="rules" name="rules" value="rules"> <small>Wyrażam zgodę na przesyłanie mi przez serwis Game-Market.pl za pomocą środków komunikacji elektronicznej informacji handlowych (np. newsletterów).</small>
		</div>
	</div>
		<div id="addButton">
				<input id="submit" class="btn btn-warning" type="submit" value="Dodaj ogłoszenie" style="color:#fff;">
		</div>

	</form>
</div>

