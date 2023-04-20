<section class="faqs">
    <div class="container">
        <?php while( have_rows('faqs') ) : the_row();
            $faq_question = get_sub_field('faq_question');
            $faqs_answer = get_sub_field('faqs_answer'); ?>
            <div class="faqs__text__cont">
                <button class="faqs__text__cont--faqs"><?php echo $faq_question ?><i class="fas fa-plus"></i></button>
                <div class="panel"><?php echo $faqs_answer ?></div>
            </div>
        <?php endwhile; ?>
    </div>
</section>