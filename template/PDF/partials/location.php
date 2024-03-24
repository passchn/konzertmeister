<?php

declare(strict_types=1);

/**
 * @var \League\Plates\Template\Template $this
 * @var \Passchn\Konzertmeister\Event\Event $event
 * @var \Passchn\Konzertmeister\Export\FormatterInterface $_formatter
 */

$hasNameAndAddress = $event->location->name && $event->location->formattedAddress;

?>
<?php if ($hasNameAndAddress) : ?>
    <?= $event->location->name ?> <br>
    <small class="muted">
        <?= $_formatter->formattedAddress($event) ?>
    </small>
<?php else : ?>
    <?= $event->location->name ?>
    <?= $_formatter->formattedAddress($event) ?>
<?php endif; ?>