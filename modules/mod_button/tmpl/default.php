<?php

// Prevenção de repetição de chamadas
$typeLink     = $params->get('type_link');
$menuItem     = $params->get('menu');
$externalUrl  = $params->get('external_url');
$classButton  = $params->get('class_button');
$titleParam   = $params->get('title');
$typeImage    = $params->get('type_image');
$icon         = $params->get('icon');
$imageParam   = $params->get('image');
$headerClass  = $params->get('header_class');

// Monta o link
$link = ($typeLink === 'menu_item') 
    ? JRoute::_('index.php?Itemid=' . (int) $menuItem) 
    : $externalUrl;

// Classe do botão
$class = !empty($classButton) ? 'btn-' . htmlspecialchars($classButton) : '';

// Título
$titleText = !empty($titleParam) ? strip_tags($titleParam) : '';
$title = $titleText !== '' ? '<span>' . htmlspecialchars($titleText) . '</span>' : '';

// Imagem ou ícone
$image = '';
if ($typeImage === 'icon' && !empty(trim((string) $icon))) {
    $image = '<i class="' . htmlspecialchars($icon) . '"></i>';
} elseif ($typeImage === 'image' && !empty(trim((string) $imageParam))) {
    $imageSrc = htmlspecialchars($imageParam, ENT_QUOTES, 'UTF-8');
    $image = '<img src="' . $imageSrc . '" alt="' . htmlspecialchars($titleText) . '" />';
}

?>

<div id="modbutton" class="<?= htmlspecialchars($headerClass) ?>">

    <a href="<?= htmlspecialchars($link) ?>" class="btn <?= $class ?>">

        <?= $image ?> <?= $title ?>

    </a>

</div>
