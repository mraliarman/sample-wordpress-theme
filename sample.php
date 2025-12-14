<?php
/**
 * فایل نمونه WP_Query با 4 مثال مختلف
 * هر بخش شامل توضیح فارسی و عنوان است
 * این فایل می‌تواند در قالب یا قالب فرزند استفاده شود
 */

?>

<div class="space-y-12">

    <?php
    // =========================================================
    // مثال 1: گرفتن آخرین 5 پست وبلاگ
    // =========================================================
    $args1 = [
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'order'          => 'DESC',
    ];
    $query1 = new WP_Query($args1);

    if($query1->have_posts()):
    ?>
        <div>
            <h2 class="text-xl font-bold mb-4">آخرین 5 پست وبلاگ</h2>
            <ul class="space-y-4">
                <?php while($query1->have_posts()): $query1->the_post(); ?>
                    <li class="p-4 bg-gray-50 rounded-lg shadow-sm">
                        <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:underline"><?php the_title(); ?></a>
                        <p class="text-sm text-gray-500"><?php echo get_the_date(); ?></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // =========================================================
    // مثال 2: گرفتن پست‌های دسته‌بندی خاص (مثلا دسته news)
    // =========================================================
    $args2 = [
        'post_type'      => 'post',
        'category_name'  => 'news',
        'posts_per_page' => 10,
    ];
    $query2 = new WP_Query($args2);

    if($query2->have_posts()):
    ?>
        <div>
            <h2 class="text-xl font-bold mb-4">پست‌های دسته‌بندی News</h2>
            <?php while($query2->have_posts()): $query2->the_post(); ?>
                <div class="mb-4 p-4 border rounded">
                    <h3 class="text-lg font-semibold"><?php the_title(); ?></h3>
                    <p class="text-gray-600"><?php the_excerpt(); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // =========================================================
    // مثال 3: گرفتن پست‌های سفارشی (Custom Post Type) با فیلتر متا
    // =========================================================
    $args3 = [
        'post_type'      => 'products',
        'posts_per_page' => 8,
        'meta_query'     => [
            [
                'key'     => 'price',
                'value'   => 100,
                'compare' => '>=',
                'type'    => 'NUMERIC'
            ]
        ],
    ];
    $query3 = new WP_Query($args3);

    if($query3->have_posts()):
    ?>
        <div>
            <h2 class="text-xl font-bold mb-4">محصولات با قیمت بالاتر از 100</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php while($query3->have_posts()): $query3->the_post(); ?>
                    <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">
                        <h3 class="font-semibold mb-2"><?php the_title(); ?></h3>
                        <p class="text-gray-500"><?php echo get_post_meta(get_the_ID(),'price',true); ?> تومان</p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // =========================================================
    // مثال 4: گرفتن پست‌ها با چند دسته‌بندی و برچسب
    // =========================================================
    $args4 = [
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'category__in'   => [3,5],
        'tag__in'        => [7,9],
    ];
    $query4 = new WP_Query($args4);

    if($query4->have_posts()):
    ?>
        <div>
            <h2 class="text-xl font-bold mb-4">پست‌ها با چند دسته و برچسب خاص</h2>
            <?php while($query4->have_posts()): $query4->the_post(); ?>
                <div class="mb-3 p-3 border rounded bg-gray-50">
                    <a href="<?php the_permalink(); ?>" class="text-blue-600 font-medium hover:underline"><?php the_title(); ?></a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php
    endif;
    wp_reset_postdata();
    ?>

</div>
