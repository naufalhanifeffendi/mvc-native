<?php if (!empty($_SESSION['flash'])): ?>
    <p style="color: <?= $_SESSION['flash']['type'] === 'success' ? 'green' : 'red' ?>;">
        <?= htmlspecialchars($_SESSION['flash']['message']) ?>
    </p>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>