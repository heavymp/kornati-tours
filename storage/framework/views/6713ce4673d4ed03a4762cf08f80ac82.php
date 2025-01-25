<div
    x-data="{
        show: false,
        init() {
            this.$watch('$store.wireui.loading', value => {
                this.show = value
            })
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;"
>
    <div class="flex items-center space-x-4 rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
        <div class="h-8 w-8">
            <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Loading...</span>
    </div>
</div> <?php /**PATH C:\Users\mate\OneDrive\Dokumenti\Cursor\Kornati\project-bolt-sb1-6vgshprr\project\resources\views/filament/loading-indicator.blade.php ENDPATH**/ ?>