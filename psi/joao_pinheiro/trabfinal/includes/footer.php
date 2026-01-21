    </main>
    
    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3"><i class="bi bi-box-seam me-2"></i>Sistema de Gestão</h5>
                    <p class="text-white-50 mb-0">Sistema completo para gestão de produtos e fornecedores.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-white-50 mb-0">Desenvolvido para fins educacionais</p>
                    <p class="text-white-50 mb-0">&copy; 2024 - Todos os direitos reservados</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Toast Activation Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activate all toasts
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 5000
            });
        });
        toastList.forEach(function(toast) {
            toast.show();
        });
    });
    </script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo SITE_URL; ?>/js/main.js"></script>
</body>
</html>

