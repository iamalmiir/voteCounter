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