@if(session('success') || session('error'))
<div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50">
    @if(session('success'))
    <div id="alert-success" class="alert bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg flex items-center justify-between animate-fade-in">
        <span>{{ session('success') }}</span>
        <button onclick="closeAlert('alert-success')">&times;</button>
    </div>
    @endif

    @if(session('error'))
    <div id="alert-error" class="alert bg-red-100 border-l-4 border-red-500 text-red-800 p-4 rounded-lg flex items-center justify-between animate-fade-in">
        <span>{{ session('error') }}</span>
        <button onclick="closeAlert('alert-error')">&times;</button>
    </div>
    @endif
</div>
@endif

<style>
.alert {
    min-width: 300px;
    max-width: 90%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
function closeAlert(id) {
    const alert = document.getElementById(id);
    if (alert) {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        setTimeout(() => { alert.remove(); }, 300);
    }
}

// Masquer automatiquement après 5 secondes
document.addEventListener('DOMContentLoaded', () => {
    ['alert-success', 'alert-error'].forEach(id => {
        const alert = document.getElementById(id);
        if(alert){
            setTimeout(() => closeAlert(id), 5000);
        }
    });
});
</script>
