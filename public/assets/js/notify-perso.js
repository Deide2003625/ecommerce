const { Warning } = require("postcss");

function JsNotify(type, mainMessage, secondaryMessage) {
    // Define classes based on type
    const typeClasses = {
        error: {
            border: 'border-red-500',
            bg: 'bg-slate-800',
            text: 'text-red-500',
            icon: '<svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
        },
        success: {
            border: 'border-green-500',
            bg: 'bg-slate-800',
            text: 'text-green-400',
            icon: '<svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
        },
        warning: {
            border: 'border-yellow-500',
            bg: 'bg-slate-800',
            text: 'text-yellow-400',
            icon: '<svg class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
        },
    };

    // Check if type is valid
    if (!typeClasses[type]) {
        console.error('Invalid notification type');
        return;
    }

    // Destructure the type-specific classes
    const {border, bg, text, icon} = typeClasses[type];

    // Create the notification HTML
    const notificationHtml = `
        <div class="notify fixed inset-0 flex items-end justify-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
          <div x-data="{ show: true }" x-init="setTimeout(() => { show = true }, 500)" x-show="show" x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="pointer-events-auto w-full max-w-sm overflow-hidden shadow-lg rounded-lg border-l-4 ${bg} ${border}">
            <div class="relative rounded-lg shadow-xs overflow-hidden">
              <div class="p-1">
                <div class="flex items-start">
                  ${icon}
                  <div class="ml-2 w-0 flex-1">
                    <p class="text-sm leading-5 font-medium capitalize text-white">${mainMessage}</p>
                    <p class="mt-1 text-sm leading-5 text-white">${secondaryMessage}</p>
                  </div>
                  <div class="ml-2 flex shrink-0">
                    <button @click="show = false;" class="inline-flex rounded-md text-slate-400 hover:text-slate-500 focus:outline-none">
                      <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
    $('#laravel-notify').append(notificationHtml);
    setTimeout(() => {
        $('.notify').remove();
    }, 5000);
}

