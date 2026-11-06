    </div><!-- .content -->
</div><!-- .main -->

<script>
    // Live clock
    function updateClock() {
        const el = document.getElementById('clock');
        if (el) {
            const now = new Date();
            el.textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
        }
    }
    updateClock();
    setInterval(updateClock, 1000);

    // Mobile sidebar toggle
    const sidebar = document.getElementById('sidebar');
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
        }
    });

    // Auto-hide alerts after 4s
    document.querySelectorAll('.alert').forEach(el => {
        setTimeout(() => {
            el.style.transition = 'opacity 0.4s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        }, 4000);
    });

    // Confirm delete dialogs
    document.querySelectorAll('[data-confirm]').forEach(el => {
        el.addEventListener('click', (e) => {
            if (!confirm(el.dataset.confirm)) e.preventDefault();
        });
    });
</script>
</body>
</html>
