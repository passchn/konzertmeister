<?php

declare(strict_types=1);

/**
 * @var \League\Plates\Template\Template $this
 * @var \Passchn\Konzertmeister\Event\Location $location
 */

$hasNameAndAddress = $location->name && $location->formattedAddress;

?>
<?php if ($hasNameAndAddress) : ?>
    <?= $location->name ?> <br>
    <small class="muted">
        <?= $location->formattedAddress ?>
    </small>
<?php else : ?>
    <?= $location->name ?>
    <?= $location->formattedAddress ?>
<?php endif; ?>