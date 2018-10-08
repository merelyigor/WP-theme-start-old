<?php
/**
 * Функция вывода шаблона комментариев   <?= comments_template(); ?> - использовать для вывода comments.php описанный тут
 * ---------------------------------------------------------------------------------------------------------------------
 */
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) // открываем шаблон коментариев
    die ('Страница на прямую не грузится.))');

if (!empty($post->post_password)) : // Если есть пароль  на коментарии
    if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) :  // И это не соответствует файлу cookie (пароль)
        ?>

        <p class="nocomments">Ведите пароль</p>

        <?php
        return;
    endif;
endif; ?>




<?php/************** ------- начало вывода комментариев - обертка всех комментов и формы коментариев ------- **************/?>
    <div class="item__comments">
        <?php if ($comments) : // открывается вывод коментариев ?>



            <div class="head" id="respond"><?php/************** ------- вывод заголовка с кол. коментов ------- **************/?>
                <h4>Комментарии по теме (<span class="comments-count"><?php comments_number('0', '1', '%'); //кол. коментов ?></span>)</h4>
            </div>


            <?php/************** ------- обертка всех комментов без формы коментариев ------- **************/?>
            <div class="comments">
                <?php
                function mytheme_comment($comment, $args ) { // вывод всех коментов?>
                    <?php/************** ------- начало шаблона вывода коментариев ------- **************/?>


                    <?php echo 'div'; comment_class( empty( $args['has_children'] ) ? 'клас не для родителя ' : 'класс для родителя' );//Вывод классов коментария ?>

                    <?php comment_ID()//Выводит id коментария ?>




                    <?php
                    if ( $args['avatar_size'] != 0 ) :
                        echo get_avatar( $comment, $args['70x70'] ); //вывод аватара и его размер
                    endif; ?>

                    <?php printf( __( '<div class="обертка-вывода-автора">%s</div>' ), get_comment_author_link() ); // вывод имя автора комментария и его обертка
                    ?>




                    <?php
                    if ( $comment->comment_approved == '0' ) : // вывод если коментарий на проверке - видет только пользователь отправивший комент на своем коменте
                        echo '<div>тут старт обертка вывода коментарий на проверке</div>';
                        _e( 'Ваш комментарий находится на проверке - вы увидете его после одобрения модератором' );
                        echo '<div>тут конец обертка вывода коментарий на проверке</div>';
                    endif; ?>



                    <?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); // выводит ссылку на комментарий ?>


                    <?php
                    /* translators: 1: date, 2: time *//************** ------- выводит датту комментария и время строкой ------- **************/
                    printf(
                        __('%1$s at %2$s'),
                        get_comment_date(),
                        get_comment_time()
                    ); ?>


                    <?php /************** ------- выводит ссылку со словом (Редактировать) - для редактирования комментария ------- **************/
                    edit_comment_link( __( '(Редактировать)' ), 'перед ссылкой', 'после ссылки' ); ?>




                    <?php comment_text(); // вывод тела комментария ?>



                    <?php    /************** ------- выводит ссылку со словом (Ответить) - для ответа на коммент ------- **************/
                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'add_below' => 'comment',
                                'before' => '<div>перед ссылкой</div>',
                                'after' => '<div>после ссылки</div>',
                                'login_text' => 'Для ответа нужно войти или зарегистрироваться',
                                'reply_text' => 'Ответить', // текст ссылки ответа
                                'respond_id' => 'form1', // ID формы комментирования для перемещения к форме при клике на ответ
                                'depth'     => '3', // ссылка выводится глубиной вложенности до 3го коммента
                            )
                        )
                    ); ?>






                <?php }  /************** ------- конец шаблона вывода коментариев ------- **************/ ?>

                <?php wp_list_comments('type=comment&callback=mytheme_comment'); // вывод шаблона ?>


            </div>
            <?php/************** ------- обертка всех комментов без формы коментариев ------- **************/?>
























        <?php else : /************** ------- Это отображается, если комментариев пока нет. ------- **************/ ?>

            <?php if ('open' == $post->comment_status) : //Если комментарии открыты, но комментариев нет.

                echo 'Если комментарии открыты, но комментариев нет.';

            else : // комментарии закрыты

                echo 'Если комментарии закрыты, и комментариев нет.';

            endif;

        endif; /************** ------- Это отображается, если комментариев пока нет. ------- **************/?>




        <?php if ('open' == $post->comment_status) : // открывается вывод формы ?>

            <div class="form-text-area" id="form1">

                <div class="cancel-comment-reply">
                    <small><?php cancel_comment_reply_link(); ?></small>
                </div>

                <?php

                $args = [
                    'logged_in_as' => '<span class="text__coment__user">Вы вошли как:</span><br><a class="user__profile" href="' . admin_url('profile.php') . '"><i class="fa fa-grav icon-user"></i>' . $user_identity . '</a>  '
                        . '<br><a class="user__profile__exit" href="' . wp_logout_url(apply_filters('the_permalink', get_permalink($post_id))) . '"><i class="fa fa-blind icon-user"></i>Выйти?</a>',
                ];

                ?>

                <?php comment_form($args); ?>

            </div>

        <?php endif; // закрывается вывод формы коментариев ?>
    </div> <?php/************** ------- начало вывода комментариев - обертка всех комментов и формы коментариев ------- **************/?>



















<div class="reviews__comm">
    <?php


    function process_comment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment;
    ?>

    <li <?php comment_class(); ?>>
        <img src="//www.gravatar.com/avatar/<?php echo md5(get_comment_author_email()) ?>?d=mm&s=150" class="idx__feedback__info__slider__img">
        <div class="idx__feedback__info__slider__name"><?php comment_author_link(); ?></div>
        <div class="idx__feedback__info__slider__date"><?php comment_date('d F Y h:i'); ?></div>
        <div class="idx__feedback__info__slider__text"><?php comment_text(); ?></div>

        <?php } ?>



        <ul class="idx__feedback__info__slider reviews__comm__slider">

            <?php
            $comments = get_comments(array(
                'post_id' => 0,
                'status' => 'approve',
                'order'               => 'DESC',
            ));

            wp_list_comments( array(
                'type' => 'comment',
                'style' => 'li',
                'callback' => 'process_comment',
                'walker' => new CustomCommentsWalker,
            ), $comments);
            ?>


        </ul>


        <div class="reviews__comm__pag">
            <?php custom_comment_pagination(1); ?>
        </div>


        <div class="reviews__comm__ctrls">
            <div class="reviews__comm__ctrls__btn reviews__comm__ctrls__btn--left reviews__comm__ctrls__btn--disable">
                <div class="reviews__comm__ctrls__btn__icon">
                    <svg><use xlink:href="#arrow-left"></use></svg>
                </div>
            </div>
            <div class="reviews__comm__ctrls__text js-give-review">Оставьте свой отзыв</div>
            <div class="reviews__comm__ctrls__btn reviews__comm__ctrls__btn--right reviews__comm__ctrls__btn--right">
                <div class="reviews__comm__ctrls__btn__icon">
                    <svg><use xlink:href="#arrow-right"></use></svg>
                </div>
            </div>
        </div>
</div>


