<?php require(base_path('views/partials/head.php')) ?>
<?php //require(base_path('views/partials/nav.php')) ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold">An error occurred.</h1>

        <p class="mt-4">
            <!-- display the error message passed from the exception handler-->
            <p class="text-red-500 mb-2"><?= $message ?></p>
            <a href="/" class="text-blue-500 underline">Go back home.</a>
        </p>
    </div>
</main>

<?php require(base_path('views/partials/footer.php')) ?>
