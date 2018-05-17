<?php
/**
 * Хлебные крошки
 * ---------------------------------------------------------------------------------------------------------------------
 */
function the_theme_name_breadcrumb()
{

	global $post;
	if (!is_home()) {
		echo '<a href="' . site_url() . '">' . esc_html__('Главная') . '<svg>
                        <use xlink:href="' . get_template_directory_uri() . '/img/sprite-inline.svg#icon-arrow"></use>
                    </svg></a>';
		if (is_single()) { // записи
			the_category(', ');
			echo "<li><i class=\"fa fa-angle-double-right margin-right\" aria-hidden=\"true\"></i></li>";
			echo '<li>';
			the_title();
			echo '</li>';
		} elseif (is_page()) {
			echo '<span>' . get_the_title() . '</span>';
		} elseif (is_category()) { // категории
			global $wp_query;
			$obj_cat = $wp_query->get_queried_object();
			$current_cat = $obj_cat->term_id;
			$current_cat = get_category($current_cat);
			$parent_cat = get_category($current_cat->parent);
			if ($current_cat->parent != 0)
				echo(get_category_parents('<li>' . $parent_cat, TRUE, '<i class="fa fa-angle-double-right margin-right" aria-hidden="true"></i></li> '));
			single_cat_title();
		} elseif (is_search()) { // страницы поиска
			echo esc_html__('Результаты поиска по запросу "', 'owl_blog') . get_search_query() . '"';
		} elseif (is_tag()) { // теги или (метки)
			echo single_tag_title('', false);
		} elseif (is_day()) { // архивы (по дням)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li><li> / </li>';
			echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li><li> / </li> ';
			echo get_the_time('d');
		} elseif (is_month()) { // архивы (по месяцам)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li><li> / </li>';
			echo get_the_time('F');
		} elseif (is_year()) { // архивы (по годам)
			echo get_the_time('Y');
		} elseif (is_author()) { // авторы
			global $author;
			$userdata = get_userdata($author);
			echo '<li>Все статьи автора ' . $userdata->display_name . '</li>';
		} elseif (is_404()) { // если станица не существует
			echo '<li>' . esc_html__('Страница не найдена', 'owl_blog') . '</li>';
		}

		if (get_query_var('paged')) // номер текущей страницы
			echo ' (' . get_query_var('paged') . '-я страница блога)';

	} else { // Главная
		$pageNum = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if ($pageNum > 1)
			echo '<li><i class="fa fa-tree fa-tree-float margin-right" aria-hidden="true"></i>
<a href="' . site_url() . '">' . esc_html__('Главная', 'owl_blog') . '</a></li>
<li><i class="fa fa-angle-double-right margin-right" aria-hidden="true"></i></li>
<li>' . $pageNum . '- страница блога</li>'; //fix close <i> and add <li>-page</li>
		else
			echo '<li><i class="fa fa-tree fa-tree-float margin-right" aria-hidden="true">

</i>' . esc_html__('Главная', 'owl_blog') . '</li>';
	}
}