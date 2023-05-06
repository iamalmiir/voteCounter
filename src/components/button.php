<?php
function button($text, $type): string
{
    return "
    <div>
      <button
        type=$type
        class='flex w-full justify-center rounded-md bg-sky-950 px-3 py-2 text-sm font-semibold text-white
        shadow-md hover:bg-sky-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
        focus-visible:outline-indigo-600'
      >
        $text
      </button>
    </div>
    ";
}

function logInOutButton($text, $href): string
{
    return "
    <div class='hidden sm:ml-6 sm:flex sm:items-center'>
      <div class='relative cursor-pointer ml-3'>
        <a
          href=$href
          class='flex rounded-md bg-sky-950 text-md text-white py-2 px-6 shadow-lg
          cursor-pointer hover:bg-sky-900 focus:outline-none'
          id='user-menu-button'
          aria-expanded='false'
          aria-haspopup='true'
        >
          $text
        </a>
      </div>
    </div>
    <div class='sm:hidden'>
      <div class='relative cursor-pointer m-3'>
        <a
          href=$href
          class='flex rounded-md bg-sky-950 text-md text-white py-2 px-6 shadow-lg
          cursor-pointer hover:bg-sky-900 focus:outline-none'
          id='user-menu-button'
          aria-expanded='false'
          aria-haspopup='true'
        >
          $text
        </a>
      </div>
    ";
}
