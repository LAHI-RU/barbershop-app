<div x-data="{ 
    open: false, 
    message: '', 
    confirmAction: null,
    trigger(msg, action) {
        this.message = msg;
        this.confirmAction = action;
        this.open = true;
    },
    proceed() {
        if (this.confirmAction) {
            this.confirmAction();
        }
        this.open = false;
    }
}" 
x-show="open" 
x-on:elite-confirm.window="trigger($event.detail.message, $event.detail.action)"
class="fixed inset-0 z-[100] flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto"
style="display: none;"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 transition-opacity bg-black/80 backdrop-blur-xl" x-show="open" x-transition:enter="transition ease-out duration-300" x-on:click="open = false"></div>

    <!-- Modal Content -->
    <div class="relative w-full max-w-lg overflow-hidden bg-gray-900 border shadow-2xl rounded-3xl border-gold/20 transform transition-all"
         x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-8"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0">
        
        <div class="p-8">
            <div class="flex items-center justify-center mb-6">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-gold/10 border border-gold/20 animate-pulse">
                    <i class="fas fa-exclamation-triangle text-gold text-2xl"></i>
                </div>
            </div>

            <p class="text-gray-400 text-center font-medium leading-relaxed mb-10" x-text="message"></p>

            <div class="flex gap-4">
                <button @click="open = false" class="flex-1 px-6 py-4 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 border border-white/10">
                    Withdraw
                </button>
                <button @click="proceed()" class="flex-1 px-6 py-4 bg-gold hover:bg-white text-black rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-xl shadow-gold/20">
                    Proceed
                </button>
            </div>
        </div>
        
        <!-- Subtle Gold Gradient Bottom -->
        <div class="h-1 bg-gradient-to-r from-transparent via-gold/50 to-transparent opacity-30"></div>
    </div>
</div>

<script>
    window.confirmElite = function(message, form) {
        window.dispatchEvent(new CustomEvent('elite-confirm', {
            detail: {
                message: message,
                action: () => {
                    form.submit();
                }
            }
        }));
    };
</script>
