<x-admin.layout title="Pemindai QR - Panel Admin" pageTitle="Pemindai QR">
    <x-slot name="styles">
        <style>
            .scanner-container {
                background: #1f2937;
                border: 1px solid #374151;
                border-radius: 24px;
                padding: 32px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }
            
            .details-container {
                background: #1f2937;
                border: 1px solid #374151;
                border-radius: 24px;
                padding: 32px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }
            
            .qr-reader-container {
                border: 3px dashed #374151;
                border-radius: 20px;
                padding: 32px;
                text-align: center;
                background: #111827;
                transition: all 0.3s ease;
            }
            
            .qr-reader-container:hover {
                border-color: #3b82f6;
                background: #1f2937;
            }
            
            .start-camera-btn {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: white;
                padding: 16px 32px;
                border-radius: 16px;
                font-weight: 600;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                font-size: 16px;
            }
            
            .start-camera-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
            }
            
            .search-btn {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: white;
                padding: 12px 20px;
                border-radius: 12px;
                font-weight: 600;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
            }
            
            .search-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
            }
            
            .manual-input:focus {
                outline: none;
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }
            
            .status-alert {
                padding: 16px 20px;
                border-radius: 12px;
                margin-top: 16px;
                font-weight: 500;
                display: flex;
                align-items: center;
            }
            
            .booking-info-card {
                background: #111827;
                border: 1px solid #2d3748;
                border-radius: 16px;
                padding: 24px;
                margin-bottom: 20px;
            }
            
            .info-grid {
                display: grid;
                grid-template-columns: 1fr 2fr;
                gap: 12px;
                align-items: center;
            }
            
            .info-label {
                font-weight: 600;
                color: #9ca3af;
                font-size: 14px;
            }
            
            .info-value {
                color: #e5e7eb;
                font-size: 14px;
            }
            
            .action-button {
                padding: 12px 20px;
                border-radius: 12px;
                font-weight: 600;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                text-decoration: none;
                font-size: 14px;
            }
            
            .action-button:hover {
                transform: translateY(-2px);
            }
            
            .btn-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: white;
            }
            
            .btn-success:hover {
                box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            }
            
            .btn-danger {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: white;
            }
            
            .btn-danger:hover {
                box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
            }
            
            .btn-secondary {
                background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
                color: white;
            }
            
            .btn-secondary:hover {
                box-shadow: 0 8px 25px rgba(107, 114, 128, 0.3);
            }

            #qr-reader {
                width: 100% !important;
                border-radius: 16px !important;
                overflow: hidden;
            }

            #qr-reader__dashboard_section_csr {
                display: none !important;
            }

            #qr-reader__status_span {
                display: none !important;
            }

            #qr-reader__scan_region {
                background: transparent !important;
                border-radius: 12px !important;
            }

            .modal-backdrop {
                background: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(4px);
            }
            
            .modal-content {
                background: #1f2937;
                border: 1px solid #374151;
                border-radius: 16px;
            }
        </style>
    </x-slot>

    <x-admin.page-header 
        title="Pemindai Kode QR"
        description="Pindai kode QR pelanggan untuk melihat detail reservasi dan update status pembayaran"
        icon="fas fa-qrcode"
        iconColor="green" />

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Scanner Section -->
        <x-admin.card-container class="scanner-container">
            <x-slot name="title">Kamera Pemindai</x-slot>
            <x-slot name="icon">fas fa-camera</x-slot>
            <x-slot name="iconColor">blue</x-slot>
            
            <div class="mb-6">
                <div id="qr-reader" class="qr-reader-container">
                    <div id="qr-reader-placeholder" class="py-12">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-camera text-white text-3xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-4">Siap untuk Scan</h4>
                        <p class="text-gray-400 mb-6">Klik tombol di bawah untuk memulai kamera</p>
                        <button id="start-camera" class="start-camera-btn">
                            <i class="fas fa-video mr-3"></i>Mulai Kamera
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-600 pt-6">
                <label for="manual-code" class="block text-sm font-semibold text-gray-300 mb-3">
                    <i class="fas fa-keyboard mr-1"></i>Atau masukan kode reservasi secara manual:
                </label>
                <div class="flex space-x-3">
                    <input type="text" 
                           id="manual-code" 
                           placeholder="Masukkan kode reservasi" 
                           class="manual-input flex-1">
                    <button onclick="scanManualCode()" class="search-btn">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </div>
            </div>
            
            <div id="scanner-status" class="hidden">
                <div id="status-message" class="status-alert"></div>
            </div>
        </x-admin.card-container>

        <!-- Details Section -->
        <x-admin.card-container class="details-container">
            <x-slot name="title">Detail Reservasi</x-slot>
            <x-slot name="icon">fas fa-ticket-alt</x-slot>
            <x-slot name="iconColor">green</x-slot>
            
            <div id="booking-details" class="hidden">
            </div>
            
            <div id="no-booking" class="text-center py-16">
                <div class="w-20 h-20 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-gray-400 text-3xl"></i>
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Belum ada reservasi yang dipindai</h4>
                <p class="text-gray-400">Pindai kode QR atau masukkan kode reservasi untuk melihat detail</p>
            </div>
        </x-admin.card-container>
    </div>

    <!-- Recent Scans Table -->
    <x-admin.table-container 
        title="Riwayat Pindaian" 
        icon="fas fa-history" 
        iconColor="purple"
        class="mt-8">
        
        <x-slot name="thead">
            <tr>
                <th>Waktu</th>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>Film</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </x-slot>

        <tbody id="recent-scans">
            <x-admin.empty-state 
                colspan="6"
                icon="fas fa-clock"
                title="Tidak ada pemindaian saat ini"
                description="Riwayat pemindaian akan tampil di sini" />
        </tbody>
    </x-admin.table-container>

    <!-- Status Update Modal -->
    <x-modal id="statusModal" title="Update Status" icon="fas fa-edit">
        <div id="statusModalContent"></div>
    </x-modal>

    <x-slot name="scripts">
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script>
        let html5QrCode = null;
        let recentScans = [];
        let currentBooking = null;

        document.getElementById('start-camera').addEventListener('click', function() {
            startQrScanner();
        });

        const urlParams = new URLSearchParams(window.location.search);
        const prefilledCode = urlParams.get('code');
        if (prefilledCode) {
            document.getElementById('manual-code').value = prefilledCode;
            scanManualCode();
        }

        function startQrScanner() {
            const qrReaderElement = document.getElementById('qr-reader');
            qrReaderElement.innerHTML = '';
            
            html5QrCode = new Html5Qrcode("qr-reader");
            
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    const cameraId = devices[0].id;
                    
                    html5QrCode.start(
                        cameraId,
                        {
                            fps: 10,
                            qrbox: { width: 300, height: 300 }
                        },
                        (decodedText, decodedResult) => {
                            onScanSuccess(decodedText);
                        },
                        (errorMessage) => {
                        }
                    ).then(() => {
                        showStatus('Camera started successfully', 'success');
                        document.getElementById('start-camera').style.display = 'none';
                    }).catch(err => {
                        showStatus('Failed to start camera: ' + err, 'error');
                    });
                } else {
                    showStatus('No cameras found', 'error');
                }
            }).catch(err => {
                showStatus('Tidak dapat mengakses kamera: ' + err, 'error');
            });
        }

        function stopQrScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    showStatus('Camera stopped', 'info');
                    document.getElementById('qr-reader').innerHTML = `
                        <div id="qr-reader-placeholder" class="py-12">
                            <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-camera text-white text-3xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-white mb-4">Ready to Scan</h4>
                            <p class="text-gray-400 mb-6">Click the button below to start your camera</p>
                            <button id="start-camera" class="start-camera-btn" onclick="startQrScanner()">
                                <i class="fas fa-video mr-3"></i>Start Camera
                            </button>
                        </div>
                    `;
                }).catch(err => {
                    console.error('Failed to stop scanner:', err);
                });
                html5QrCode = null;
            }
        }

        function onScanSuccess(decodedText) {
            fetchBookingDetails(decodedText);
            stopQrScanner();
        }

        function scanManualCode() {
            const code = document.getElementById('manual-code').value.trim();
            if (code) {
                fetchBookingDetails(code);
            } else {
                showStatus('Mohon masukkan kode booking', 'error');
            }
        }

        function fetchBookingDetails(uniqueCode) {
            showStatus('Sedang mencari...', 'info');
            
            fetch(`{{ route('admin.scan-booking') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ unique_code: uniqueCode })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentBooking = data.booking;
                    displayBookingDetails(data.booking);
                    addToRecentScans(data.booking);
                    showStatus('Kode berhasil ditemukan', 'success');
                } else {
                    showStatus('Kode tidak berhasil ditemukan', 'error');
                    hideBookingDetails();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showStatus('Error fetching booking details', 'error');
                hideBookingDetails();
            });
        }

        function displayBookingDetails(booking) {
            document.getElementById('no-booking').style.display = 'none';
            document.getElementById('booking-details').style.display = 'block';
            
            const seatsHtml = booking.seats.map(seat => 
                `<span class="inline-block bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded-full font-medium mr-1">${seat.row}${seat.number}</span>`
            ).join('');

            const statusClass = getStatusClass(booking.status);
            const totalAmount = booking.schedule.price * booking.seats.length;

            const detailsHtml = `
                <div class="space-y-6">
                    <div class="booking-info-card">
                        <h4 class="font-semibold text-white mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-blue-400"></i>Informasi Pelanggan
                        </h4>
                        <div class="info-grid">
                            <span class="info-label">Nama:</span>
                            <span class="info-value font-semibold">${booking.customer_name}</span>
                            <span class="info-label">Nomor HP:</span>
                            <span class="info-value">${booking.customer_phone}</span>
                            <span class="info-label">Kode Booking:</span>
                            <span class="info-value font-mono bg-gray-800 px-2 py-1 rounded text-sm">${booking.unique_code}</span>
                            <span class="info-label">Status:</span>
                            <span class="info-value">
                                <span class="px-3 py-1 text-xs rounded-full font-semibold ${statusClass}" id="current-status">
                                    ${booking.status.replace('_', ' ').toUpperCase()}
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="booking-info-card">
                        <h4 class="font-semibold text-white mb-4 flex items-center">
                            <i class="fas fa-film mr-2 text-green-400"></i>Film & Jadwal
                        </h4>
                        <div class="info-grid">
                            <span class="info-label">Film:</span>
                            <span class="info-value font-semibold">${booking.schedule.movie.title}</span>
                            <span class="info-label">Gedung:</span>
                            <span class="info-value">${booking.schedule.studio.cinema.name}</span>
                            <span class="info-label">Lokasi:</span>
                            <span class="info-value text-sm">${booking.schedule.studio.cinema.location}</span>
                            <span class="info-label">Studio:</span>
                            <span class="info-value">${booking.schedule.studio.name}</span>
                            <span class="info-label">Tanggal:</span>
                            <span class="info-value">${new Date(booking.schedule.start_time).toLocaleDateString('id-ID', { 
                                weekday: 'long', 
                                year: 'numeric', 
                                month: 'long', 
                                day: 'numeric' 
                            })}</span>
                            <span class="info-label">Jadwal:</span>
                            <span class="info-value font-medium">${new Date(booking.schedule.start_time).toLocaleTimeString('id-ID', { 
                                hour: '2-digit', 
                                minute: '2-digit' 
                            })} - ${new Date(booking.schedule.end_time).toLocaleTimeString('id-ID', { 
                                hour: '2-digit', 
                                minute: '2-digit' 
                            })} WIB</span>
                        </div>
                    </div>

                    <div class="booking-info-card">
                        <h4 class="font-semibold text-white mb-4 flex items-center">
                            <i class="fas fa-couch mr-2 text-purple-400"></i>Kursi & Pembayaran
                        </h4>
                        <div class="info-grid">
                            <span class="info-label">Kursi:</span>
                            <div class="info-value">${seatsHtml}</div>
                            <span class="info-label">Harga per Kursi:</span>
                            <span class="info-value">Rp ${booking.schedule.price.toLocaleString('id-ID')}</span>
                            <span class="info-label">Total Kursi:</span>
                            <span class="info-value font-semibold">${booking.seats.length}</span>
                            <span class="info-label">Total Harga:</span>
                            <span class="info-value font-bold text-green-400 text-lg">Rp ${totalAmount.toLocaleString('id-ID')}</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3" id="action-buttons">
                        ${getActionButtons(booking)}
                    </div>
                </div>
            `;

            document.getElementById('booking-details').innerHTML = detailsHtml;
        }

        function getActionButtons(booking) {
            let buttons = '';
            
            if (booking.status === 'pending_payment') {
                buttons += `
                    <button onclick="updateBookingStatus('${booking.unique_code}', 'paid')" 
                            class="action-button btn-success">
                        <i class="fas fa-check mr-2"></i>Tandai sebagai Dibayar
                    </button>
                    <button onclick="updateBookingStatus('${booking.unique_code}', 'cancelled')" 
                            class="action-button btn-danger">
                        <i class="fas fa-times mr-2"></i>Batalkan Booking
                    </button>
                `;
            } else if (booking.status === 'paid') {
                buttons += `
                    <button onclick="updateBookingStatus('${booking.unique_code}', 'cancelled')" 
                            class="action-button btn-danger">
                        <i class="fas fa-ban mr-2"></i>Batalkan (Refund)
                    </button>
                `;
            } else if (booking.status === 'cancelled') {
                buttons += `
                    <button onclick="updateBookingStatus('${booking.unique_code}', 'pending_payment')" 
                            class="action-button btn-success">
                        <i class="fas fa-undo mr-2"></i>Reaktivasi
                    </button>
                `;
            }
            
            buttons += `
                <button onclick="printBookingDetails()" 
                        class="action-button btn-secondary">
                    <i class="fas fa-print mr-2"></i>Print Detail
                </button>
            `;
            
            return buttons;
        }

        function updateBookingStatus(uniqueCode, newStatus) {
            const confirmMessage = `Apakah kamu yakin kamu ingin ${newStatus === 'paid' ? 'tandai booking ini sebagai Dibayar?' : newStatus === 'cancelled' ? 'membatalkan booking ini?' : 'update status booking ini?'}?`;
            
            if (!confirm(confirmMessage)) return;
            
            showStatus('Mengupdate status booking...', 'info');
            
            fetch(`{{ route('admin.update-booking-status') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ 
                    unique_code: uniqueCode,
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentBooking = data.booking;
                    showStatus('Status booking berhasil diupdate', 'success');
                    
                    const statusElement = document.getElementById('current-status');
                    statusElement.textContent = newStatus.replace('_', ' ').toUpperCase();
                    statusElement.className = `px-3 py-1 text-xs rounded-full font-semibold ${getStatusClass(newStatus)}`;
                    
                    document.getElementById('action-buttons').innerHTML = getActionButtons(data.booking);
                    
                    updateRecentScansTable();
                } else {
                    showStatus('Gagal untuk update status booking: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showStatus('Error mengupdate status booking', 'error');
            });
        }

        function hideBookingDetails() {
            document.getElementById('booking-details').style.display = 'none';
            document.getElementById('no-booking').style.display = 'block';
        }

        function addToRecentScans(booking) {
            const scanData = {
                time: new Date().toLocaleString('id-ID'),
                code: booking.unique_code,
                customer: booking.customer_name,
                movie: booking.schedule.movie.title,
                status: booking.status
            };
            
            recentScans.unshift(scanData);
            if (recentScans.length > 10) {
                recentScans.pop();
            }
            
            updateRecentScansTable();
        }

        function updateRecentScansTable() {
            const tbody = document.getElementById('recent-scans');
            
            if (recentScans.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-700 rounded-full flex items-center justify-center mb-6">
                                    <i class="fas fa-clock text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-white mb-2">Tidak ada pindaian terbaru</h3>
                                <p class="text-gray-400 text-sm">Riwayat pemindaian akan tampil di sini</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }
            
            tbody.innerHTML = recentScans.map(scan => `
                <tr class="hover:bg-gray-800 transition-colors">
                    <td class="px-6 py-4 text-sm text-white">${scan.time}</td>
                    <td class="px-6 py-4 text-sm font-mono text-gray-300 bg-gray-800 rounded">${scan.code}</td>
                    <td class="px-6 py-4 text-sm font-medium text-white">${scan.customer}</td>
                    <td class="px-6 py-4 text-sm text-gray-300">${scan.movie}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full font-semibold ${getStatusClass(scan.status)}">
                            ${scan.status.replace('_', ' ').toUpperCase()}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="fetchBookingDetails('${scan.code}')" 
                                class="text-blue-400 hover:text-blue-300 p-2 hover:bg-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function getStatusClass(status) {
            switch(status) {
                case 'pending_payment':
                    return 'bg-yellow-900 text-yellow-300';
                case 'paid':
                    return 'bg-green-900 text-green-300';
                case 'cancelled':
                    return 'bg-red-900 text-red-300';
                default:
                    return 'bg-gray-700 text-gray-300';
            }
        }

        function showStatus(message, type) {
            const statusDiv = document.getElementById('scanner-status');
            const statusMessage = document.getElementById('status-message');
            
            statusDiv.classList.remove('hidden');
            statusMessage.className = 'status-alert';
            
            switch(type) {
                case 'success':
                    statusMessage.classList.add('bg-green-100', 'text-green-800', 'border-green-200');
                    statusMessage.innerHTML = `<i class="fas fa-check-circle mr-2"></i>${message}`;
                    break;
                case 'error':
                    statusMessage.classList.add('bg-red-100', 'text-red-800', 'border-red-200');
                    statusMessage.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i>${message}`;
                    break;
                case 'info':
                    statusMessage.classList.add('bg-blue-100', 'text-blue-800', 'border-blue-200');
                    statusMessage.innerHTML = `<i class="fas fa-info-circle mr-2"></i>${message}`;
                    break;
            }
            
            if (type !== 'info') {
                setTimeout(() => {
                    statusDiv.classList.add('hidden');
                }, 4000);
            }
        }

        function printBookingDetails() {
            window.print();
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        document.getElementById('manual-code').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                scanManualCode();
            }
        });

        window.addEventListener('beforeunload', function() {
            stopQrScanner();
        });
        </script>
    </x-slot>
</x-admin.layout>