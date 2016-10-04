<div class="wrap">

	<?php screen_icon(); ?>

	<h2><?php _e( $this->name ); ?></h2>
    
    <?php include('plugin_fields.php'); ?>

	<form method="post" action="options.php">

		<?php settings_fields( $this->tag.'_options' ); ?>

		<table class="form-table">
        
        	<?php

				foreach ($contact_details as $value){
					echo '<tr valign="top">
							<th>
								<label for="'.$this->tag.'['.$value.']">'. ucwords($value) .'</label>
							</th>
							<td>
								<input type="text" class="regular-text" value="'. $this->options[$value] .'" id="'.$this->tag.'['.$value.']" name="'.$this->tag.'['.$value.']"/> <span>Declaration: contact_detail(&#39;'.$value.'&#39;)</span>
							</td>
						</tr>';
				}

			?>
		</table>

		<p class="submit">

			<input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />

		</p>
        
        <p>For use in template file:</p>
        <p> &#60;&#63;php if (function_exists('contact_detail')) { contact_detail('##VALUE##'); } &#63;&#62;</p>

	</form>

</div>

