<?php
function formHeader($title, $subtitle, $option, $formIcon, $linkTo = ''): string
{
    $icon = $formIcon === 'login' ? 'fa-arrow-right-to-bracket' : 'fa-user-plus';

    return "
    <div class='sm:mx-auto sm:w-full sm:max-w-md'>
      <i class='fa-solid $icon flex mx-auto h-12 w-auto text-sky-950'></i>
      <h2
        class='mt-6 text-center text-3xl font-bold tracking-tight text-sky-950'
      >
        $title
      </h2>
      <p class='mt-2 text-center text-sm text-gray-600'>
        $subtitle
        <a
          href=$linkTo
          class='font-medium text-sky-600 hover:text-sky-500'
        >
          $option
        </a>
      </p>
    </div>
    ";
}