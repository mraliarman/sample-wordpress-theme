<?php
// اگر پست دارای رمز باشد، بخش دیدگاه‌ها نمایش داده نشود
if(post_password_required()){
	return;
}
?>

<div id="comments" class="mt-12">
	
	<?php // عنوان بخش دیدگاه‌ها ?>
	<h3 class="text-2xl font-bold mb-8">
		<?php echo get_comments_number(); ?> دیدگاه
	</h3>

	<?php // شروع لیست دیدگاه‌ها ?>
	<?php if(have_comments()): ?>
		
		<ul class="space-y-8">
			
			<?php
			// نمایش دیدگاه‌ها به صورت تو در تو
			wp_list_comments([
				'style'      => 'ul',
				'avatar_size'=> 56,
				'max_depth'  => 4,
				'callback'   => function($comment,$args,$depth){
			?>
			
			<?php // شروع یک آیتم دیدگاه ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class('relative'); ?>>
				
				<?php // بدنه کلی دیدگاه ?>
				<div class="flex gap-4 <?php echo $depth > 1 ? 'mr-8 mt-6' : ''; ?>">
					
					<?php // بخش آواتار نویسنده دیدگاه ?>
					<div class="shrink-0">
						<?php echo get_avatar($comment,56,'','',['class'=>'rounded-full border']); ?>
					</div>
					
					<?php // محتوای متنی دیدگاه ?>
					<div class="flex-1 bg-white rounded-2xl shadow-sm p-5">
						
						<?php // هدر دیدگاه: نام و تاریخ ?>
						<div class="flex items-center justify-between mb-2">
							
							<div class="flex items-center gap-2">
								
								<?php // نام نویسنده دیدگاه ?>
								<span class="font-semibold text-sm text-gray-800">
									<?php comment_author(); ?>
								</span>
								
								<?php // نمایش برچسب مدیر در صورت ادمین بودن ?>
								<?php if(user_can($comment->user_id,'administrator')): ?>
									<span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">
										مدیر
									</span>
								<?php endif; ?>
								
							</div>
							
							<?php // تاریخ ارسال دیدگاه ?>
							<span class="text-xs text-gray-400">
								<?php comment_date(); ?>
							</span>
							
						</div>
						
						<?php // پیام در انتظار تایید ?>
						<?php if($comment->comment_approved == '0'): ?>
							<p class="text-xs text-orange-600 mb-2">
								دیدگاه شما در انتظار تایید است
							</p>
						<?php endif; ?>
						
						<?php // متن اصلی دیدگاه ?>
						<div class="text-sm text-gray-700 leading-relaxed">
							<?php comment_text(); ?>
						</div>
						
						<?php // لینک پاسخ به دیدگاه ?>
						<div class="mt-4">
							<?php
							comment_reply_link(array_merge($args,[
								'depth'     => $depth,
								'max_depth'=> $args['max_depth'],
								'reply_text'=> 'پاسخ',
								'class'     => 'text-xs font-medium text-blue-600 hover:text-blue-800'
							]));
							?>
						</div>
						
					</div>
					<?php // پایان محتوای متنی دیدگاه ?>
					
				</div>
				<?php // پایان بدنه کلی دیدگاه ?>
				
			</li>
			<?php // پایان یک آیتم دیدگاه ?>
			
			<?php
				}
			]);
			?>
			
		</ul>
		
	<?php endif; ?>
	<?php // پایان لیست دیدگاه‌ها ?>

	<?php // فرم ارسال دیدگاه ?>
	<?php if(comments_open()): ?>
		
		<div class="mt-14">
			
			<h4 class="text-lg font-semibold mb-4">
				ارسال دیدگاه جدید
			</h4>
			
			<?php
			comment_form([
				'title_reply'  => '',
				'label_submit' => 'ارسال دیدگاه',
				'class_form'   => 'space-y-4',
				'class_submit' => 'bg-blue-600 text-white px-8 py-2 rounded-xl hover:bg-blue-700',
				'comment_field'=> '
					<textarea
						name="comment"
						rows="5"
						class="w-full border rounded-xl p-4"
						placeholder="نظر خود را بنویسید">
					</textarea>
				',
				'fields'=>[
					'author'=>'
						<input
							name="author"
							class="w-full border rounded-xl p-3"
							placeholder="نام">
					',
					'email'=>'
						<input
							name="email"
							class="w-full border rounded-xl p-3"
							placeholder="ایمیل">
					'
				]
			]);
			?>
			
		</div>
		
	<?php endif; ?>
	<?php // پایان فرم ارسال دیدگاه ?>

</div>
<?php // پایان کانتینر اصلی دیدگاه‌ها ?>
