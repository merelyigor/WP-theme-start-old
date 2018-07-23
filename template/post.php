<?php the_permalink(); // Ссылка на пост ?>

<?php the_post_thumbnail($id, 'medium', $attr); // Выводит изображение поста в теге <img> --- large - medium - thumbnail ?>

<?= get_the_post_thumbnail( $id, 'medium', $attr ); // Получает изображение поста в теге <img> --- large - medium - thumbnail ?>

<?= get_the_post_thumbnail_url($id,'medium',$attr); // Выводит ссылкку на изображение поста --- large - medium - thumbnail ?>

<?php the_title(); // Заголовок поста ?>

<?php the_excerpt(); //Краткий текст поста с выводом тега more и тремя точками + лишние параграфы сверху и внизу ?>

<?php echo substr(strip_tags($post->post_content), 0, 250); // обрезка превью текста поста до 250 символов ?>

<?php get_the_excerpt(); //Краткий текст поста с выводом тега more и тремя точками - нет лишних параграфов или тегов ?>

<?php the_author_posts_link(); // Ссылка на автора поста ?>

<?php echo the_author(); // Имя автора поста ?>

<?php the_tags('<ul><li>','</li><li>','</li></ul>'); // Вывод в списке меток или если нет меток то категорий поста
/************** ------- the_tags( $before, $separator, $after ); ------ синтаксис использования ----

                      $before(строка)
                      Текст перед ссылками.
                      По умолчанию: 'Tags: '
                      $separator(строка)
                      Разделитель между ссылками.
                      По умолчанию: ', '
                      $after(строка)
                      Текст после ссылок.
                      По умолчанию: нет

 * ------- **************/?>

<?php the_time(' Y/m/d H:i '); // Дата публикации поста ?>

<?php comments_popup_link('<i class="fa fa-comments-o"></i> 0', '<i class="fa fa-comments-o"></i> 1', '<i class="fa fa-comments-o"></i> %');
// Вывод количевства коментариев в миниатюре поста ?>
