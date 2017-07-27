<ol class="breadcrumb page-head-nav">
    <?php
        $quotes = [

            array('quote' => 'I always wanted to be somebody, but I should have been more specific.', 'author' => 'Lily Tomlin'),
            array('quote' => 'I never worry about action, but only inaction.', 'author' => 'Winston Churchill'),
            array('quote' => 'Success is determined by those whom prove the impossible, possible.', 'author' => 'James Pence'),
            array('quote' => 'It is not uncommon for people to spend their whole life waiting to start living.', 'author' => 'Eckhart Tolle'),
            array('quote' => 'You have power over your mind — not outside events. Realize this, and you will find strength.', 'author' => 'Marcus Aurelius'),

        ];


            ?>
                <p style="font-weight: 300; font-size: 14px;"><?php $rand = rand(0,4); echo $quotes[$rand]['quote'].' - '.$quotes[$rand]['author'] ?></p>
            <?php

    ?>

</ol>
