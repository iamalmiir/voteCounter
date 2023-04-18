<?php
require_once __DIR__ . "/../../config.php";
global $err;
global $success;
global $info;
global $warning;
global $message;

$bannerClass = "flex items-center gap-x-6 bg-gray-900 px-6 py-2.5 sm:px-3.5 sm:before:flex-1";
// Check the message type and update the class variable accordingly
if (isset($err)) {
    $bannerClass .= " bg-red-500";
} else if (isset($success)) {
    $bannerClass .= " bg-green-700";
} else if (isset($info)) {
    $bannerClass .= " bg-blue-500";
} else if (isset($warning)) {
    $bannerClass .= " bg-yellow-500";
}

if (isset($message)) { ?>
    <div id="info-banner" class="<?php echo $bannerClass ?>">
        <p id="info-banner-text" class="text-sm leading-6 text-white">
            <strong class="font-semibold">Server: </strong>
            <svg viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true">
                <circle cx="1" cy="1" r="1"/>
            </svg>
            <?php echo $message; ?>
        </p>
        <div class="flex flex-1 justify-end">
            <button id="btn-close-info-banner" type="button" class="-m-3 p-3 focus-visible:outline-offset-[-4px]">
                <span class="sr-only">Dismiss</span>
                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path
                        d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                </svg>
            </button>
        </div>
    </div>
<?php } ?>
<script>
    const btnCloseInfoBanner = $("#btn-close-info-banner");
    btnCloseInfoBanner.click(() => {
        $("#info-banner").fadeOut("slow");
    })
</script>
