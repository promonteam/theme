<br>
<form class="input-group searchform" role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    <input type="text" class="form-control" placeholder="<?php _e('Search for', 'bootstrap4'); ?>..."
           value="<?php echo get_search_query(); ?>" name="s" id="s">
    <span class="input-group-btn">
    <input class="btn btn-secondary" type="submit" id="searchsubmit"
           value="<?php echo esc_attr__(__('Search', 'bootstrap4')); ?>"/>
  </span>
</form>