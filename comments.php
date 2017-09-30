<div id="comments">
	<?php if (post_password_required() || get_theme_mod('disqus_id', 'default') == 'default' || get_theme_mod('disqus_id', 'default') == '' || !comments_open()) : ?>
		<?php _e('The comments aren\'t enabled.', 'bootstrap4'); ?>
	<?php else : ?>
        <div id="disqus_thread"></div>
        <script>
            var disqus_config = function () {
                this.page.url = '<?php echo get_permalink(); ?>';
                this.page.identifier = '<?php disqus_identifier(); ?>';
            };
            (function () {
                var d = document, s = d.createElement('script');
                s.src = 'https://<?php echo get_theme_mod('disqus_id', 'default'); ?>.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments.</a>
        </noscript>
	<?php endif; ?>
</div>