<div id="contact-social">
    <ul class="contact-social social<?= $params->get('moduleclass_sfx') ?>">

        <?php
        //Telefone
        if (!empty($phone)) : ?>
            <li class="phone">
                <a href="tel:+55<?php echo preg_replace("/[^0-9]/", "", $phone); ?>" target="_blank">
                    <span><?php echo $phone; ?></span>
                </a>
            </li>
            <li class="phone small">
                <a href="tel:+55<?php echo preg_replace("/[^0-9]/", "", $phone); ?>" target="_blank">
                    <i class="fa fa-phone"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php
        //Facebook
        if (!empty($facebook)) : ?>
            <li>
                <a href="<?php echo $facebook; ?>" target="_blank" class="facebook">
                    <i class="fa fa-facebook-square"></i>
                </a>
            </li>
        <?php endif;

        //Twitter
        if (!empty($twitter)) : ?>
            <li>
                <a href="<?php echo $twitter; ?>" target="_blank" class="twitter">
                    <i class="fa fa-twitter-square"></i>
                </a>
            </li>
        <?php endif;

        //Youtube
        if (!empty($youtube)) : ?>
            <li>
                <a href="<?php echo $youtube; ?>" target="_blank" class="youtube">
                    <i class="fa fa-youtube-play"></i>
                </a>
            </li>
        <?php endif;

        //Instagram
        if (!empty($instagram)) : ?>
            <li>
                <a href="<?php echo $instagram; ?>" target="_blank" class="instagram">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
        <?php endif;

        //Linkedin
        if (!empty($linkedin)) : ?>
            <li>
                <a href="<?php echo $linkedin; ?>" target="_blank" class="linkedin">
                    <i class="fa fa-linkedin-square"></i>
                </a>
            </li>
        <?php endif;

        //E-mail
        if (!empty($email)) : ?>
            <li>
                <a href="mailto:<?php echo $email; ?>" target="_blank" class="email">
                    <i class="fa fa-envelope"></i>
                </a>
            </li>
        <?php endif;

        //WhatsApp
        if (!empty($whatsapp)) :
        ?>
            <li>
                <a href="https://api.whatsapp.com/send?phone=+55<?php echo $whatsappNumber; ?><?php if (!empty($whatsapp_msg)) echo '&text=' . $whatsapp_msg; ?>" target="_blank" class="">
                    <i class="fa fa-whatsapp"></i>
                </a>
            </li>
        <?php
        endif;
        
        //Endereço
        if (!empty($endereco)) : ?>
            <li>
                <a href="<?php echo $endereco; ?>" target="_blank" class="endereco">
                    <i class="fa fa-map-marker"></i>
                </a>
            </li>
        <?php endif;
        ?>
    </ul>



</div>