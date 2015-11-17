			<div class="push"></div>
		</div>
		<footer class="row row--invert footer">
			<div class="<?php if (!is_archive() && !is_front_page() && !is_search()) echo 'cell'; ?> well">
				<div class="g">
					<?php if (is_archive() || is_front_page() || is_search()) : ?><div class="g-b"><?php endif; ?>
					<div class="g-b g-b--center">
						<?php quindo_footer_nav() ?>
						<h6 class="footer-copy">The Young Post © 2015</h6>
					</div>
					<?php if (is_archive() || is_front_page() || is_search()) : ?></div><?php endif; ?>
				</div>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>