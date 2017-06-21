<?php
/**
 * Accommodation Brand Taxonomy Content Part
 *
 * @package 	tour-operator
 * @category	accommodation-brand
 */
?>

<?php
	$description = term_description();
	if ( ! empty( $description ) ) :
?>

	<div class="lsx-to-archive-header row">
		<div class="col-xs-12 <?php echo lsx_to_has_enquiry_contact() ? 'col-sm-8 col-md-9' : '' ?> lsx-to-archive-description">
			<?php echo wp_kses_post( $description ); ?>
		</div>

		<?php if ( lsx_to_has_enquiry_contact() ) : ?>
			<div class="col-xs-12 col-sm-4 col-md-3">
				<div class="lsx-to-contact-widget">
					<?php
						if ( function_exists( 'lsx_to_has_team_member' ) && lsx_to_has_team_member() ) {
							lsx_to_team_member_panel( '<div class="lsx-to-contact">', '</div>' );
						} else {
							lsx_to_enquiry_contact( '<div class="lsx-to-contact">', '</div>' );
						}

						lsx_to_enquire_modal();
					?>
				</div>
			</div>
		<?php endif ?>
	</div>

<?php endif ?>
