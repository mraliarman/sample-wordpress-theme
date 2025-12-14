<?php
/**
 * فایل single-post.php
 * نمایش تکی نوشته‌های معمولی (پست‌ها)
 */
get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post(); ?>
		<article class="max-w-4xl mx-auto my-10 bg-white rounded-2xl shadow-lg overflow-hidden">
			<!-- تصویر شاخص -->
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="relative">
					<?php the_post_thumbnail( 'large', [ 'class' => 'w-full h-96 object-cover' ] ); ?>
					<span class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></span>
					<h1 class="absolute bottom-6 right-6 text-3xl md:text-4xl font-bold text-white drop-shadow-lg">
						<?php the_title(); ?>
					</h1>
				</div>
			<?php else : ?>
				<div class="bg-gray-100 h-60 flex items-center justify-center">
					<h1 class="text-3xl font-bold text-gray-600"><?php the_title(); ?></h1>
				</div>
			<?php endif; ?>

			<!-- محتوای نوشته -->
			<div class="p-6 md:p-10">
				<!-- متا اطلاعات -->
				<div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-6 border-b pb-4">
					<span class="flex items-center gap-1">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
							stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.788.607 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
						</svg>
						<?php the_author(); ?>
					</span>
					<span class="flex items-center gap-1">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
							stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
						<?php echo get_the_date(); ?>
					</span>
					<span class="flex items-center gap-1 text-blue-600">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
							stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M3 7h18M9 3v4m6-4v4m-7 8l3 3 3-3" />
						</svg>
						<?php the_category( ', ' ); ?>
					</span>
				</div>

				<!-- محتوای اصلی -->
				<div class="prose prose-lg prose-blue max-w-none text-gray-800 leading-relaxed">
					<?php the_content(); ?>
				</div>
			</div>

			<?php
				$selected_attribute_value = get_post_meta( get_the_ID(), 'post_single_link_url', true );
				$selected_attribute_value_2 = get_post_meta( get_the_ID(),'post_single_link_title', true );
				if($selected_attribute_value_2){
					echo '<a href="' . esc_url( $selected_attribute_value ) . '" class="selected_attribute_value">' . esc_html( $selected_attribute_value_2 ) . '</a>';
				}
			?>
		</article>

		<?php // نمایش دیدگاه‌ها
			if (comments_open() || get_comments_number()) {
				comments_template();
			}
		?>

		<!-- نوشته‌های مرتبط -->
		<?php
		$categories = wp_get_post_categories( get_the_ID() );
		if ( $categories ) :
			$related = new WP_Query( [
				'category__in' => $categories,
				'post__not_in' => [ get_the_ID() ],
				'posts_per_page' => 3,
			] );
			if ( $related->have_posts() ) : ?>
				<section class="max-w-5xl mx-auto mt-12 mb-16 px-4">
					<h2 class="text-2xl font-bold text-gray-800 mb-6 border-r-4 border-blue-500 pr-3">مطالب مرتبط</h2>
					<div class="grid gap-6 md:grid-cols-3">
						<?php while ( $related->have_posts() ) :
							$related->the_post(); ?>
							<div
								class="bg-white rounded-xl shadow hover:shadow-lg transition-transform hover:-translate-y-1 overflow-hidden group">
								<a href="<?php the_permalink(); ?>" class="block relative">
									<?php if ( has_post_thumbnail() ) :
										the_post_thumbnail( 'medium_large', [ 'class' => 'w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500' ] );
									else : ?>
										<img src="<?php echo MYTHEME_URI; ?>/assets/img/no-image.jpg" alt="<?php the_title(); ?>"
											class="w-full h-48 object-cover opacity-80">
									<?php endif; ?>
									<span class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></span>
									<h3 class="absolute bottom-3 right-4 text-white text-lg font-semibold drop-shadow"><?php the_title(); ?>
									</h3>
								</a>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>
					</div>
				</section>
			<?php endif; endif; ?>
	<?php endwhile; endif;
get_footer(); ?>