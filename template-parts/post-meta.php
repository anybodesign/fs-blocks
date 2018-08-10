<?php if ( !defined('ABSPATH') ) die();
/**
 * Template part for displaying the post meta.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FS_Porfolio
 * @since 1.0
 * @version 1.0
 */
?>

							<div class="post-meta">
								<p class="meta-infos">
									<?php _e( 'Posted on&nbsp;', 'fs-porfolio' ); ?><?php echo the_time( get_option('date_format') ); ?>
									<?php _e( 'by&nbsp;', 'fs-porfolio' ); ?><?php the_author(); ?>
									<?php _e( 'in&nbsp;', 'fs-porfolio' ); ?><?php the_category(', '); ?>
								</p>
								
								<?php if ( ! get_comments_number()==0 ) : ?>
								<p class="meta-comments">
									<a href="<?php the_permalink() ?>#comments"><?php comments_number('0', '1', '%'); ?> <?php _e( 'Comment(s)', 'fs-porfolio' ); ?></a>
								</p>
		    					<?php endif; ?>
							</div>