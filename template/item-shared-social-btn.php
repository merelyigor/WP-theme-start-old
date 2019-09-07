<?php
/**
 * Шаблон вывода кнопок шаринга соц сетей
 * ---------------------------------------------------------------------------------------------------------------------
 */ ?>

<div class="item__share">
    <h6>хотите поделиться ?</h6>
    <div class="items">

        <div class="share-item share-item_vk">
            <a title="Поделиться ВКонтакте" href="http://vk.com/share.php?url=<?php
            the_permalink(); ?>" target="_blank" rel="nofollow">
                <div class="share-item__icon"></div>
            </a>
        </div>

        <div class="share-item share-item_titter">
            <a title="Поделиться в Twitter" href="http://twitter.com/share?url=<?php
            the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" rel="nofollow">
                <div class="share-item__icon"></div>
            </a>
        </div>

        <div class="share-item share-item_fb">
            <a title="Поделиться в facebook" href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php
            the_permalink(); ?>&p[title]=<?php the_title(); ?>" target="_blank" rel="nofollow">
                <div class="share-item__icon"></div>
            </a>
        </div>

        <div class="share-item share-item_gplus">
            <a title="Поделиться в Google Plus" href="https://plus.google.com/share?url=<?php
            the_permalink(); ?>" target="_blank" rel="nofollow">
                <div class="share-item__icon"></div>
            </a>
        </div>

        <div class="share-item share-item_myworld">
            <a title="Поделиться в MailRu" href="http://connect.mail.ru/share?url=<?php
            the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow">
                <div class="share-item__icon"></div>
            </a>
        </div>

        <div class="share-item share-item_ok">
            <a title="Поделиться в Однокласники" href="http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php
            the_permalink(); ?>&st.comments=<?php the_title(); ?>" target="_blank" rel="nofollow">
                <div class="share-item__icon"></div>
            </a>
        </div>

    </div>
</div>