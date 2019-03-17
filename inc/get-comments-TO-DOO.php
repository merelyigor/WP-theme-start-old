<?php
/**
 * получение на вывод комментариев
 * ---------------------------------------------------------------------------------------------------------------------
 */
/************** ------- Уберает поле сайт из формы комментариев ------- **************/
add_filter('comment_form_default_fields', function ($fields) {
    unset($fields['url']);
    return $fields;
});


function get__comments()
{
    $post_id = $_POST['post_id'];
    $current_page = $_POST['current_page'];
    $per_page = get_option('comments_per_page');

    $args = array(
        'post_id' => $post_id,
        'number' => $per_page,
        'order' => 'ASC',
        'offset' => $per_page * $current_page
    );

    $comments = get_comments($args);

    foreach ($comments as $comment) {

        $comment->date = get_comment_date('d F Y h:i', $comment->comment_ID);
        $comment->img = '//www.gravatar.com/avatar/' . md5(get_comment_author_email($comment->comment_ID)) . '?d=mm&s=150';

        unset($comment->user_id);
        unset($comment->comment_parent);
        unset($comment->comment_type);
        unset($comment->comment_agent);
        unset($comment->comment_approved);
        unset($comment->comment_karma);
        unset($comment->comment_date_gmt);
        unset($comment->comment_date);
        unset($comment->comment_author_IP);
        unset($comment->comment_author_url);
        unset($comment->comment_author_email);
        unset($comment->comment_post_ID);
        unset($comment->comment_ID);

    }

    wp_send_json_success($comments);


}

add_action("wp_ajax_get_comments", "get__comments");
add_action("wp_ajax_nopriv_get_comments", "get__comments");

/******************************************************************
 *
 * использование для разметки
 *
 * <?php
 *
 *
 * function process_comment($comment, $args, $depth){
 * $GLOBALS['comment'] = $comment;
 * ?>
 *
 * <li <?php comment_class(); ?>>
 * <img src="//www.gravatar.com/avatar/<?php echo md5(get_comment_author_email()) ?>?d=mm&s=150" class="idx__feedback__info__slider__img">
 * <div class="idx__feedback__info__slider__name"><?php comment_author_link(); ?></div>
 * <div class="idx__feedback__info__slider__date"><?php comment_date('d F Y h:i'); ?></div>
 * <div class="idx__feedback__info__slider__text"><?php comment_text(); ?></div>
 *
 * <?php } ?>
 *
 * использование для вывода
 *
 *
 *
 * <?php
 * $comments = get_comments(array(
 * 'post_id' => 0,
 * 'status' => 'approve',
 * 'order'               => 'DESC',
 * ));
 *
 * wp_list_comments( array(
 * 'type' => 'comment',
 * 'style' => 'li',
 * 'callback' => 'process_comment',
 * 'walker' => new CustomCommentsWalker,
 * ), $comments);
 * ?>
 *******************************************************************/

