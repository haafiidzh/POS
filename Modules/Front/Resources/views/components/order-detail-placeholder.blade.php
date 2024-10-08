<div class="skeleton">
    <div class="relative z-10 -mt-12">
        <span
              class="mx-auto flex justify-center items-center size-[62px] rounded-full border border-gray-200 bg-white text-gray-700 shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
            <i class="bx bx-file text-3xl"></i>
        </span>
    </div>

    <div class="p-4 sm:p-7 overflow-y-auto">
        <div class="text-center">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                {{ cache('app_name') }}
            </h3>
            <p class="text-sm text-gray-500">
                Invoice #000000001
            </p>
        </div>

        <div class="mt-5 sm:mt-10 grid grid-cols-2 sm:grid-cols-3 gap-5">
            <div>
                <span class="block text-xs uppercase text-gray-500">Amount paid:</span>
                <span class="block text-sm font-medium text-gray-800 dark:text-gray-200"></span>
            </div>

            <div>
                <span class="block text-xs uppercase text-gray-500">Date Created:</span>
                <span class="block text-sm font-medium text-gray-800 dark:text-gray-200"></span>
            </div>

            <div>
                <span class="block text-xs uppercase text-gray-500">Payment method:</span>
                <div class="flex items-center gap-x-2">
                    <span class="block text-sm font-medium text-gray-800 dark:text-gray-200">
                        Bank Trasfer
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-5 sm:mt-10">
            <h4 class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">Rincian</h4>

            <ul class="mt-3 flex flex-col">
                <li
                    class="inline-flex items-center gap-x-2 p-2 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                    <div class="flex items-center justify-between w-full">
                        <a class="hover:text-gray-600" href="" target="_blank">
                            <p></p>
                            <span class="text-xs text-slate-400">x1</span>
                        </a>
                        <span class="text-sm text-black"></span>
                    </div>
                </li>
            </ul>

            <div class="grid grid-cols-3">
                <div class="col-span-1"></div>
                <ul class="mt-3 flex flex-col col-span-2">
                    <li
                        class="inline-flex items-center gap-x-2 p-2 text-sm text-gray-500 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                        <div class="flex items-center justify-between w-full">
                            <span>Discount</span>
                            <span class="text-sm text-red-400"></span>
                        </div>
                    </li>
                    <li
                        class="inline-flex items-center gap-x-2 p-2 text-sm text-gray-500 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                        <div class="flex items-center justify-between w-full">
                            <span>Sub Total</span>
                            <span class="text-sm"></span>
                        </div>
                    </li>
                    <li
                        class="inline-flex items-center gap-x-2 p-2 text-sm text-gray-500 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                        <div class="flex items-center justify-between w-full">
                            <span>PPN (12%)</span>
                            <span class="text-sm"></span>
                        </div>
                    </li>
                    <li
                        class="inline-flex items-center gap-x-2 p-2 text-sm text-gray-500 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                        <div class="flex items-center justify-between w-full">
                            <span>Biaya Admin</span>
                            <span class="text-sm"></span>
                        </div>
                    </li>
                    <li
                        class="inline-flex items-center gap-x-2 p-2 text-sm font-semibold text-black -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-slate-800">
                        <div class="flex items-center justify-between w-full">
                            <span>Total</span>
                            <span></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-5 sm:mt-10">
            <p class="text-xs italic text-gray-500 max-w-2xl leading-4">
                *If you have any questions, please contact us at
                <a class="inline-flex items-center gap-x-1.5"
                   href="mailto:{{ cache('contact_email') }}">{{ cache('contact_email') }}</a> or chat
                <a class="inline-flex items-center gap-x-1.5"
                   href="{{ phone(cache('contact_phone'), 'ID', 'RFC3966') }}">
                    {{ phone(cache('contact_phone'), 'ID', 'INTERNATIONAL') }}
                </a>
            </p>
        </div>
    </div>

</div>
