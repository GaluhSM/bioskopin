@extends('layouts.admin')

@section('title', 'QR Scanner - Admin Panel')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">QR Code Scanner</h1>
    <p class="text-gray-600">Scan customer QR codes to view booking details</p>
</div>

<!-- Scanner Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- QR Scanner -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-qrcode mr-2 text-blue-600"></i>QR Code Scanner
        </h3>
        
        <!-- Camera Scanner -->
        <div class="mb-4">
            <div id="qr-reader" class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center" style="width: 100%; max-width: 400px;">
                <div id="qr-reader-placeholder" class="py-8">
                    <i class="fas fa-camera text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600 mb-4">Click "Start Camera" to begin scanning</p>
                    <button id="start-camera" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-video mr-2"></i>Start Camera
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Manual Code Input -->
        <div class="border-t pt-4">
            <label for="manual-code" class="block text-sm font-medium text-gray-700 mb-2">
                Or enter booking code manually:
            </label>
            <div class="flex space-x-2">
                <input type="text" 
                       id="manual-code" 
                       placeholder="Enter booking code" 
                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button onclick="scanManualCode()" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
            </div>
        </div>
        
        <!-- Scanner Status -->
        <div id="scanner-status" class="mt-4 p-3 rounded-lg hidden">
            <p id="status-message" class="text-sm"></p>
        </div>
    </div>

    <!-- Booking Details -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-ticket-alt mr-2 text-green-600"></i>Booking Details
        </h3>
        
        <div id="booking-details" class="hidden">
            <!-- Booking details will be displayed here -->
        </div>
        
        <div id="no-booking" class="text-center py-8 text-gray-500">
            <i class="fas fa-search text-4xl mb-4"></i>
            <p>No booking scanned yet</p>
            <p class="text-sm">Scan a QR code or enter a booking code to view details</p>
        </div>
    </div>
</div>

<!-- Recent Scans -->
<div class="mt-8 bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Recent Scans</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Movie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody id="recent-scans" class="bg-white divide-y divide-gray-200">
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No recent scans</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
#qr-reader {
    width: 100% !important;
}

#qr-reader__dashboard_section_csr {
    display: none !important;
}

#qr-reader__status_span {
    display: none !important;
}

#qr-reader__scan_region {
    background: transparent !important;
}

.booking-detail-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 0.5rem;
    align-items: center;
}

.booking-detail-grid .label {
    font-weight: 600;
    color: #374151;
}

.booking-detail-grid .value {
    color: #6B7280;
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
let html5QrCode = null;
let recentScans = [];

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
                    qrbox: { width: 250, height: 250 }
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
                <div id="qr-reader-placeholder" class="py-8 text-center">
                    <i class="fas fa-camera text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600 mb-4">Click "Start Camera" to begin scanning</p>
                    <button id="start-camera" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg" onclick="startQrScanner()">
                        <i class="fas fa-video mr-2"></i>Start Camera
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
        `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">${seat.row}${seat.number}</span>`
    ).join('');

    const statusClass = getStatusClass(booking.status);
    const totalAmount = booking.schedule.price * booking.seats.length;

    const detailsHtml = `
        <div class="space-y-6">
            <!-- Customer Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-user mr-2 text-blue-600"></i>Customer Information
                </h4>
                <div class="booking-detail-grid">
                    <span class="label">Name:</span>
                    <span class="value">${booking.customer_name}</span>
                    <span class="label">Phone:</span>
                    <span class="value">${booking.customer_phone}</span>
                    <span class="label">Booking Code:</span>
                    <span class="value font-mono">${booking.unique_code}</span>
                    <span class="label">Status:</span>
                    <span class="value">
                        <span class="px-2 py-1 text-xs rounded-full ${statusClass}">
                            ${booking.status.replace('_', ' ').toUpperCase()}
                        </span>
                    </span>
                </div>
            </div>

            <!-- Movie Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-film mr-2 text-green-600"></i>Movie & Schedule
                </h4>
                <div class="booking-detail-grid">
                    <span class="label">Movie:</span>
                    <span class="value font-semibold">${booking.schedule.movie.title}</span>
                    <span class="label">Cinema:</span>
                    <span class="value">${booking.schedule.studio.cinema.name}</span>
                    <span class="label">Location:</span>
                    <span class="value">${booking.schedule.studio.cinema.location}</span>
                    <span class="label">Studio:</span>
                    <span class="value">${booking.schedule.studio.name}</span>
                    <span class="label">Date:</span>
                    <span class="value">${new Date(booking.schedule.start_time).toLocaleDateString('id-ID', { 
                        weekday: 'long', 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    })}</span>
                    <span class="label">Showtime:</span>
                    <span class="value">${new Date(booking.schedule.start_time).toLocaleTimeString('id-ID', { 
                        hour: '2-digit', 
                        minute: '2-digit' 
                    })} - ${new Date(booking.schedule.end_time).toLocaleTimeString('id-ID', { 
                        hour: '2-digit', 
                        minute: '2-digit' 
                    })}</span>
                </div>
            </div>

            <!-- Seats & Payment -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-couch mr-2 text-purple-600"></i>Seats & Payment
                </h4>
                <div class="booking-detail-grid">
                    <span class="label">Seats:</span>
                    <div class="value">${seatsHtml}</div>
                    <span class="label">Price per seat:</span>
                    <span class="value">Rp ${booking.schedule.price.toLocaleString('id-ID')}</span>
                    <span class="label">Total seats:</span>
                    <span class="value">${booking.seats.length}</span>
                    <span class="label">Total amount:</span>
                    <span class="value font-bold text-green-600 text-lg">Rp ${totalAmount.toLocaleString('id-ID')}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-3">
                ${booking.status === 'pending_payment' ? `
                    <button onclick="markAsPaid('${booking.unique_code}')" 
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-check mr-2"></i>Mark as Paid
                    </button>
                ` : ''}
                <button onclick="printBookingDetails()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-print mr-2"></i>Print Details
                </button>
            </div>
        </div>
    `;

    document.getElementById('booking-details').innerHTML = detailsHtml;
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
        tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">No recent scans</td></tr>';
        return;
    }
    
    tbody.innerHTML = recentScans.map(scan => `
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${scan.time}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">${scan.code}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${scan.customer}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${scan.movie}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs rounded-full ${getStatusClass(scan.status)}">
                    ${scan.status.replace('_', ' ').toUpperCase()}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                <button onclick="fetchBookingDetails('${scan.code}')" 
                        class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function getStatusClass(status) {
    switch(status) {
        case 'pending_payment':
            return 'bg-yellow-100 text-yellow-800';
        case 'paid':
            return 'bg-green-100 text-green-800';
        case 'cancelled':
            return 'bg-red-100 text-red-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}

function showStatus(message, type) {
    const statusDiv = document.getElementById('scanner-status');
    const statusMessage = document.getElementById('status-message');
    
    statusDiv.classList.remove('hidden', 'bg-green-100', 'bg-red-100', 'bg-blue-100', 'text-green-800', 'text-red-800', 'text-blue-800');
    
    switch(type) {
        case 'success':
            statusDiv.classList.add('bg-green-100', 'text-green-800');
            break;
        case 'error':
            statusDiv.classList.add('bg-red-100', 'text-red-800');
            break;
        case 'info':
            statusDiv.classList.add('bg-blue-100', 'text-blue-800');
            break;
    }
    
    statusMessage.textContent = message;
    
    if (type !== 'info') {
        setTimeout(() => {
            statusDiv.classList.add('hidden');
        }, 3000);
    }
}

function markAsPaid(uniqueCode) {
    if (confirm('Mark this booking as paid?')) {
        // This would need to be implemented in the backend
        alert('This feature would update the booking status to paid in the database.');
    }
}

function printBookingDetails() {
    window.print();
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
@endsection