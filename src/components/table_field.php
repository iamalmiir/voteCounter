<?php
function table_field($text, $name, $second_name): string
{
    return "<tbody class='divide-y divide-gray-200'>
<tr>
    <td class='whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-sky-950 sm:pl-0'>
        $text
    </td>
    <td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>
        <div class='relative mt-2'>
            <label>
                <input type='number' name=$name
                       id=$name
                       max='10' min='0' step='1'
                       maxlength='2' size='2'
                       class='peer block w-full border-0 text-center bg-gray-50 py-1.5 text-sky-950
                                       sm:text-md sm:leading-6 focus:outline-none'
                       placeholder='0-10'
                       required />
                <div
                    class='absolute inset-x-0 bottom-0 border-t border-gray-300
                                    peer-focus:border-t-2
                                     peer-focus:border-sky-600'
                    aria-hidden='true'></div>
            </label>
            <div
                class='absolute inset-x-0 bottom-0 border-t border-gray-300
                                    peer-focus:border-t-2
                                     peer-focus:border-sky-600'
                aria-hidden='true'></div>
        </div>
    </td>
    <td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>
        <div class='relative mt-2'>
            <label>
                <input type='number' name=$second_name
                       id=$second_name
                       max='15' min='10' step='1'
                       maxlength='2' size='2'
                       class='peer block w-full border-0 text-center bg-gray-50 py-1.5 text-sky-950
                                       sm:text-md sm:leading-6 focus:outline-none'
                       placeholder='10-15'
                       required/>
                <div
                    class='absolute inset-x-0 bottom-0 border-t border-gray-300
                                    peer-focus:border-t-2
                                     peer-focus:border-sky-600'
                    aria-hidden='true'></div>
            </label>
        </div>
    </td>
</tr>
</tbody>";
}