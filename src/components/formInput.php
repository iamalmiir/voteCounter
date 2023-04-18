<?php
function formInput($text, $name, $type): string
{
    return "
    <div>
      <label
        for=$name
        class='block text-sm font-medium leading-6 text-sky-950'
      >
        $text
      </label>
      <div class='mt-2'>
        <input
          id=$name
          name=$name
          type=$type
          required
          class='block w-full rounded-md border-transparent p-1.5 text-sky-950 shadow-sm ring-1 ring-inset
          ring-gray-300 focus:outline-0 placeholder:text-gray-400 sm:text-sm sm:leading-6'
        />
      </div>
    </div>
    ";
}