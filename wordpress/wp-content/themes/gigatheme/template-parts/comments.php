<?php if (have_comments()) : ?>
    <ol class="post-comments">
        <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
            ));

            comment_form();
        ?>
    </ol>

<?php endif ?>