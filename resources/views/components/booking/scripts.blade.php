<script>
document.addEventListener('DOMContentLoaded', function() {
    const seatPrice = {{ $schedule->price }};
    let selectedSeats = [];
    
    @if(old('seat_ids'))
        const oldSeatIds = @json(old('seat_ids'));
        if (Array.isArray(oldSeatIds)) {
            oldSeatIds.forEach(seatId => {
                const seatBtn = document.querySelector(`[data-seat-id="${seatId}"]`);
                if (seatBtn && !seatBtn.disabled) {
                    seatBtn.classList.remove('bg-gray-600');
                    seatBtn.classList.add('bg-blue-500');
                    selectedSeats.push({
                        id: seatId,
                        label: seatBtn.dataset.seatLabel
                    });
                }
            });
            updateBookingSummary();
        }
    @endif
    
    document.querySelectorAll('.seat-btn:not([disabled])').forEach(button => {
        button.addEventListener('click', function() {
            const seatId = this.dataset.seatId;
            const seatLabel = this.dataset.seatLabel;
            
            if (this.classList.contains('bg-blue-500')) {
                this.classList.remove('bg-blue-500');
                this.classList.add('bg-gray-600');
                selectedSeats = selectedSeats.filter(seat => seat.id !== seatId);
            } else {
                if (selectedSeats.length >= 8) {
                    showNotification('Maksimal 8 kursi bisa dipilih dalam satu waktu.', 'warning');
                    return;
                }
                this.classList.remove('bg-gray-600');
                this.classList.add('bg-blue-500');
                selectedSeats.push({id: seatId, label: seatLabel});
            }
            
            updateBookingSummary();
        });
    });
    
    function updateBookingSummary() {
        const seatCount = selectedSeats.length;
        const totalPrice = seatCount * seatPrice;
        
        const selectedSeatsDiv = document.getElementById('selected-seats');
        if (seatCount === 0) {
            selectedSeatsDiv.textContent = 'Belum ada kursi yang dipilih.';
            selectedSeatsDiv.className = 'text-gray-400 text-sm min-h-[24px]';
        } else {
            selectedSeatsDiv.innerHTML = selectedSeats.map(seat => 
                `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">${seat.label}</span>`
            ).join('');
            selectedSeatsDiv.className = 'text-white text-sm min-h-[24px]';
        }
        
        document.getElementById('seat-count').textContent = seatCount;
        document.getElementById('total-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
        
        const container = document.getElementById('seat-inputs-container');
        container.innerHTML = '';
        selectedSeats.forEach(seat => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'seat_ids[]';
            input.value = seat.id;
            container.appendChild(input);
        });
        
        const submitBtn = document.getElementById('submit-btn');
        if (seatCount > 0) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-ticket-alt mr-2"></i>Pesan ' + seatCount + ' Kursi';
        } else {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-ticket-alt mr-2"></i>Pesan Sekarang';
        }
    }
    
    document.getElementById('booking-form').addEventListener('submit', function(e) {
        if (selectedSeats.length === 0) {
            e.preventDefault();
            showNotification('Please select at least one seat.', 'error');
            return;
        }
        
        const customerName = document.getElementById('customer_name').value.trim();
        const customerPhone = document.getElementById('customer_phone').value.trim();
        
        if (!customerName || !customerPhone) {
            e.preventDefault();
            showNotification('Please fill in all customer information.', 'error');
            return;
        }
        
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
        submitBtn.disabled = true;
    });
    
    document.getElementById('customer_phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.startsWith('0')) {
            value = '0' + value.slice(1);
        }
        e.target.value = value;
    });
    
    function showNotification(message, type = 'info') {
        const colors = {
            error: 'bg-red-600',
            warning: 'bg-yellow-600',
            success: 'bg-green-600',
            info: 'bg-blue-600'
        };
        
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-4 py-3 rounded-lg shadow-lg z-50`;
        notification.innerHTML = `
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span>${message}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            if (notification.parentElement) {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
    }
    
    const errorDiv = document.getElementById('error-message');
    if (errorDiv) {
        setTimeout(() => {
            errorDiv.style.opacity = '0';
            setTimeout(() => errorDiv.remove(), 300);
        }, 5000);
    }
});
</script>