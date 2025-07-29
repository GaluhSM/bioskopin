@extends('layouts.admin')

@section('title', 'QR Scanner - Admin Panel')
@section('page-title', 'QR Scanner')

@push('styles')
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
    
    .manual-input {
        background: #111827;
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #374151;
        color: white;
        border-radius: 12px;
        transition: all 0.2s ease;
        font-size: 14px;
    }
    
    .manual-input::placeholder {
        color: #6b7280;
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
    
    .recent-scans-table {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-top: 32px;
    }
    
    .table-header {
        background: #111827;
        padding: 24px;
        border-bottom: 1px solid #374151;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        background: #374151;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
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
@endpush

@section('content')
<!-- Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-white flex items-center">
        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-xl flex items-center justify-center mr-4">
            <i class="fas fa-qrcode text-white text-xl"></i>
        </div>
        QR Code Scanner
    </h1>
    <p class="text-gray-400 mt-2">Scan customer QR codes to view booking details and update payment status</p>
</div>

<!-- Main Scanner Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- QR Scanner -->
    <div class="scanner-container">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-camera text-white"></i>
            </div>
            <h3 class="text-xl font-semibold text-white">Camera Scanner</h3>
        </div>
        
        <!-- Camera Scanner -->
        <div class="mb-6">
            <div id="qr-reader" class="qr-reader-container">
                <div id="qr-reader-placeholder" class="py-12">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-camera text-white text-3xl"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-4">Ready to Scan</h4>
                    <p class="text-gray-400 mb-6">Click the button below to start your camera</p>
                    <button id="start-camera" class="start-camera-btn">
                        <i class="fas fa-video mr-3"></i>Start Camera
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Manual Code Input -->
        <div class="border-t border-gray-600 pt-6">
            <label for="manual-code" class="block text-sm font-semibold text-gray-300 mb-3">
                <i class="fas fa-keyboard mr-1"></i>Or enter booking code manually:
            </label>
            <div class="flex space-x-3">
                <input type="text" 
                       id="manual-code" 
                       placeholder="Enter booking code" 
                       class="manual-input flex-1">
                <button onclick="scanManualCode()" class="search-btn">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
            </div>
        </div>
        
        <!-- Scanner Status -->
        <div id="scanner-status" class="hidden">
            <div id="status-message" class="status-alert"></div>
        </div>
    </div>

    <!-- Booking Details -->
    <div class="details-container">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-600 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-ticket-alt text-white"></i>
            </div>
            <h3 class="text-xl font-semibold text-white">Booking Details</h3>
        </div>
        
        <div id="booking-details" class="hidden">
            <!-- Booking details will be displayed here -->
        </div>
        
        <div id="no-booking" class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-search text-gray-400 text-3xl"></i>
            </div>
            <h4 class="text-lg font-semibold text-white mb-2">No Booking Scanned</h4>
            <p class="text-gray-400">Scan a QR code or enter a booking code to view details</p>
        </div>
    </div>
</div>

<!-- Recent Scans -->
<div class="recent-scans-table">
    <div class="table-header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-history text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-white">Recent Scans</h3>
            </div>
            <span class="text-sm text-gray-400">Latest scan activity</span>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Time</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Code</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Movie</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody id="recent-scans" class="divide-y divide-gray-600">
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="empty-icon mx-auto">
                            <i class="fas fa-clock text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-300 font-medium">No recent scans</p>
                        <p class="text-gray-500 text-sm">Scan history will appear here</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50 transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-2xl rounded-2xl modal-content">
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold text-white flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-edit text-white"></i>
                </div>
                Update Status
            </h3>
            <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-300 transition-colors p-2 hover:bg-gray-700 rounded-lg">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div id="statusModalContent">
            <!-- Modal content will be loaded here -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
let html5QrCode = null;
let recentScans = [];
let currentBooking = null;

// Initialize QR Scanner
document.getElementById('start-camera').addEventListener('click', function() {
    startQrScanner();
});

// Handle URL parameter for pre-filled code
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
                    // Handle scan errors silently
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
        showStatus('Error accessing cameras: ' + err, 'error');
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
        showStatus('Please enter a booking code', 'error');
    }
}

function fetchBookingDetails(uniqueCode) {
    showStatus('Searching for booking...', 'info');
    
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
            showStatus('Booking found successfully', 'success');
        } else {
            showStatus('Booking not found', 'error');
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
            <!-- Customer Information -->
            <div class="booking-info-card">
                <h4 class="font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-user mr-2 text-blue-400"></i>Customer Information
                </h4>
                <div class="info-grid">
                    <span class="info-label">Name:</span>
                    <span class="info-value font-semibold">${booking.customer_name}</span>
                    <span class="info-label">Phone:</span>
                    <span class="info-value">${booking.customer_phone}</span>
                    <span class="info-label">Booking Code:</span>
                    <span class="info-value font-mono bg-gray-800 px-2 py-1 rounded text-sm">${booking.unique_code}</span>
                    <span class="info-label">Status:</span>
                    <span class="info-value">
                        <span class="px-3 py-1 text-xs rounded-full font-semibold ${statusClass}" id="current-status">
                            ${booking.status.replace('_', ' ').toUpperCase()}
                        </span>
                    </span>
                </div>
            </div>

            <!-- Movie Information -->
            <div class="booking-info-card">
                <h4 class="font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-film mr-2 text-green-400"></i>Movie & Schedule
                </h4>
                <div class="info-grid">
                    <span class="info-label">Movie:</span>
                    <span class="info-value font-semibold">${booking.schedule.movie.title}</span>
                    <span class="info-label">Cinema:</span>
                    <span class="info-value">${booking.schedule.studio.cinema.name}</span>
                    <span class="info-label">Location:</span>
                    <span class="info-value text-sm">${booking.schedule.studio.cinema.location}</span>
                    <span class="info-label">Studio:</span>
                    <span class="info-value">${booking.schedule.studio.name}</span>
                    <span class="info-label">Date:</span>
                    <span class="info-value">${new Date(booking.schedule.start_time).toLocaleDateString('id-ID', { 
                        weekday: 'long', 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    })}</span>
                    <span class="info-label">Showtime:</span>
                    <span class="info-value font-medium">${new Date(booking.schedule.start_time).toLocaleTimeString('id-ID', { 
                        hour: '2-digit', 
                        minute: '2-digit' 
                    })} - ${new Date(booking.schedule.end_time).toLocaleTimeString('id-ID', { 
                        hour: '2-digit', 
                        minute: '2-digit' 
                    })} WIB</span>
                </div>
            </div>

            <!-- Seats & Payment -->
            <div class="booking-info-card">
                <h4 class="font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-couch mr-2 text-purple-400"></i>Seats & Payment
                </h4>
                <div class="info-grid">
                    <span class="info-label">Seats:</span>
                    <div class="info-value">${seatsHtml}</div>
                    <span class="info-label">Price per seat:</span>
                    <span class="info-value">Rp ${booking.schedule.price.toLocaleString('id-ID')}</span>
                    <span class="info-label">Total seats:</span>
                    <span class="info-value font-semibold">${booking.seats.length}</span>
                    <span class="info-label">Total amount:</span>
                    <span class="info-value font-bold text-green-400 text-lg">Rp ${totalAmount.toLocaleString('id-ID')}</span>
                </div>
            </div>

            <!-- Action Buttons -->
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
                <i class="fas fa-check mr-2"></i>Mark as Paid
            </button>
            <button onclick="updateBookingStatus('${booking.unique_code}', 'cancelled')" 
                    class="action-button btn-danger">
                <i class="fas fa-times mr-2"></i>Cancel Booking
            </button>
        `;
    } else if (booking.status === 'paid') {
        buttons += `
            <button onclick="updateBookingStatus('${booking.unique_code}', 'cancelled')" 
                    class="action-button btn-danger">
                <i class="fas fa-ban mr-2"></i>Cancel (Refund)
            </button>
        `;
    } else if (booking.status === 'cancelled') {
        buttons += `
            <button onclick="updateBookingStatus('${booking.unique_code}', 'pending_payment')" 
                    class="action-button btn-success">
                <i class="fas fa-undo mr-2"></i>Reactivate
            </button>
        `;
    }
    
    buttons += `
        <button onclick="printBookingDetails()" 
                class="action-button btn-secondary">
            <i class="fas fa-print mr-2"></i>Print Details
        </button>
    `;
    
    return buttons;
}

function updateBookingStatus(uniqueCode, newStatus) {
    const confirmMessage = `Are you sure you want to ${newStatus === 'paid' ? 'mark this booking as paid' : newStatus === 'cancelled' ? 'cancel this booking' : 'update this booking status'}?`;
    
    if (!confirm(confirmMessage)) return;
    
    showStatus('Updating booking status...', 'info');
    
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
            showStatus('Booking status updated successfully', 'success');
            
            // Update the display
            const statusElement = document.getElementById('current-status');
            statusElement.textContent = newStatus.replace('_', ' ').toUpperCase();
            statusElement.className = `px-3 py-1 text-xs rounded-full font-semibold ${getStatusClass(newStatus)}`;
            
            // Update action buttons
            document.getElementById('action-buttons').innerHTML = getActionButtons(data.booking);
            
            // Update recent scans
            updateRecentScansTable();
        } else {
            showStatus('Failed to update booking status: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showStatus('Error updating booking status', 'error');
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
                <td colspan="6" class="px-6 py-12 text-center">
                    <div class="empty-icon mx-auto">
                        <i class="fas fa-clock text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-300 font-medium">No recent scans</p>
                    <p class="text-gray-500 text-sm">Scan history will appear here</p>
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

// Handle Enter key in manual code input
document.getElementById('manual-code').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        scanManualCode();
    }
});

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    stopQrScanner();
});
</script>
@endpush