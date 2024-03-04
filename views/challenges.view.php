<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Hello. Welcome to the programming challenges page.</p>
        <table class="table-auto border border-gray-400 mt-6">
            <thead>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Numbers between 1 & 50 that are multiples of 3 & 5</th>
                    <th class="border border-gray-400 px-4 py-2">First 20 numbers in the fibonacci sequence</th>
                    <th class="border border-gray-400 px-4 py-2">Prime numbers between 2 & 100</th>
                    <th class="border border-gray-400 px-4 py-2">Months and their letter count</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">
                            <?php if ($numbers = session()->get('numbers')): ?>
                                <ul class="ml-4 list-disc">
                                    <?php foreach ($numbers as $number): ?>
                                        <li><?= $number ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-400 px-4 py-2">
                            <?php if ($fibonacci = session()->get('fibonacci')): ?>
                                <ul class="ml-4 list-disc">
                                    <?php foreach ($fibonacci as $number): ?>
                                        <li><?= $number ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-400 px-4 py-2">
                            <?php if ($primes = session()->get('primes')): ?>
                                <ul class="ml-4 list-disc">
                                    <?php foreach ($primes as $number): ?>
                                        <li><?= $number ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-400 px-4 py-2">
                            <?php if ($months = session()->get('months')): ?>
                                <ul class="ml-4 list-disc">
                                    <?php foreach ($months as $month): ?>
                                        <li><?= $month['month'] ?> has <?= $month['letter_count'] ?> letters</li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                    </tr>
            </tbody>
    </div>
</main>

<?php require('partials/footer.php') ?>