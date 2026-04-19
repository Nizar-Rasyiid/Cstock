<div>
    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fas fa-barcode"></i>
        </span>
        <input 
            type="text" 
            wire:model.live="barcode" 
            class="form-control" 
            placeholder="Scan barcode atau ketik product code..."
            autofocus
        >
        <button class="btn btn-outline-primary" type="button" id="scannerBtn">
            <i class="fas fa-camera"></i> Camera
        </button>
    </div>

    <!-- Barcode Scanner Modal -->
    <div class="modal fade" id="qrScannerModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">📷 Scan Barcode/QR</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0 bg-dark" style="min-height: 600px;">
                    <div id="scanner-reader"></div>
                </div>
                <div class="modal-footer bg-dark">
                    <small class="text-muted">💡 Arahkan barcode ke tengah scanning area</small>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"></script>
    <script>
        let html5QrcodeScanner = null;
        const modal = document.getElementById('qrScannerModal');
        const scannerBtn = document.getElementById('scannerBtn');
        const barcodeInput = document.querySelector('input[wire\\:model\\.live="barcode"]');

        scannerBtn.addEventListener('click', async function() {
            try {
                if (!modal) {
                    alert('Modal tidak ditemukan');
                    return;
                }
                
                // Open modal dengan Bootstrap check
                if (typeof bootstrap !== 'undefined') {
                    const bsModal = new bootstrap.Modal(modal);
                    bsModal.show();
                } else {
                    modal.classList.add('show');
                    modal.style.display = 'block';
                    modal.style.zIndex = '9999';
                    document.body.classList.add('modal-open');
                }
                
                // Initialize scanner setelah modal shown
                setTimeout(initScanner, 500);
            } catch (err) {
                console.error('Modal error:', err);
                alert('Error: ' + err.message);
            }
        });

        function initScanner() {
            try {
                console.log('🎥 Initializing HTML5-QRCode scanner...');
                
                // Destroy existing scanner jika ada
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear().catch(err => {
                        console.warn('Error clearing scanner:', err);
                    });
                }
                
                // Create scanner instance
                html5QrcodeScanner = new Html5Qrcode("scanner-reader");
                
                // Configuration
                const config = {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                    aspectRatio: 1.0,
                    disableFlip: false
                };
                
                // Start scanning
                html5QrcodeScanner.start(
                    { facingMode: "environment" }, // Use rear camera
                    config,
                    onScanSuccess,
                    onScanError
                ).catch(err => {
                    console.error('❌ Camera error:', err);
                    alert('Tidak bisa akses kamera:\n' + err.message);
                    closeScanner();
                });
                
            } catch (err) {
                console.error('❌ Scanner init error:', err);
                alert('Error: ' + err.message);
                closeScanner();
            }
        }

        function onScanSuccess(decodedText, decodedResult) {
            console.log('✅ BARCODE DETECTED:', decodedText);
            
            // Extract product code dari URL jika ada
            // Format URL: http://localhost:8000/qr/SKU001 -> extract SKU001
            let productCode = decodedText;
            
            // Check jika decodedText berisi URL dengan /qr/
            if (decodedText.includes('/qr/')) {
                const match = decodedText.match(/\/qr\/([^/?]+)/);
                if (match && match[1]) {
                    productCode = match[1];
                    console.log('📝 Extracted product code from URL:', productCode);
                }
            }
            
            // Set value dan trigger Livewire update
            barcodeInput.value = productCode;
            
            // Trigger input event untuk Livewire wire:model.live
            barcodeInput.dispatchEvent(new Event('input', { bubbles: true }));
            
            // Also trigger change event for extra reliability
            barcodeInput.dispatchEvent(new Event('change', { bubbles: true }));
            
            console.log('📝 Input set to:', barcodeInput.value);
            
            // Close scanner
            closeScanner();
            
            // Close modal dengan delay kecil untuk ensure Livewire process dulu
            setTimeout(() => {
                if (typeof bootstrap !== 'undefined') {
                    const bsModal = bootstrap.Modal.getInstance(modal);
                    bsModal?.hide();
                } else {
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                    document.body.classList.remove('modal-open');
                }
            }, 200);
        }

        function onScanError(error) {
            // Silent error - scanning in progress
            // console.warn('Scanning...', error);
        }

        function closeScanner() {
            console.log('🚪 Closing scanner...');
            
            if (html5QrcodeScanner) {
                html5QrcodeScanner.stop().then(ignored => {
                    html5QrcodeScanner.clear();
                    html5QrcodeScanner = null;
                    console.log('✅ Scanner stopped');
                }).catch(err => {
                    console.warn('Error stopping scanner:', err);
                });
            }
        }

        // Close scanner when modal closes
        modal.addEventListener('hidden.bs.modal', closeScanner);
    </script>
</div>
