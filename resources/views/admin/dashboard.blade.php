<x-admin.layout title="Dashboard - Panel Admin" pageTitle="Dashboard">
    <x-slot name="styles">
        <x-booking.styles />
    </x-slot>

    <x-admin.page-header 
        title="Ringkasan Dashboard"
        description="Monitor Operasi dan Performa Bioskopin"
        icon="fas fa-chart-line"
        iconColor="blue"
        :showDateTime="true" />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-admin.metric-card 
            icon="fas fa-film"
            value="{{ $totalMovies }}"
            label="Jumlah Film"
            accentColor="#3b82f6"
            iconBg="rgba(59, 130, 246, 0.15)" />

        <x-admin.metric-card 
            icon="fas fa-building"
            value="{{ $totalCinemas }}"
            label="Jumlah Bioskop"
            accentColor="#10b981"
            iconBg="rgba(16, 185, 129, 0.15)" />

        <x-admin.metric-card 
            icon="fas fa-ticket-alt"
            value="{{ $totalBookings }}"
            label="Jumlah Reservasi"
            accentColor="#8b5cf6"
            iconBg="rgba(139, 92, 246, 0.15)" />

        <x-admin.metric-card 
            icon="fas fa-hourglass-half"
            value="{{ $pendingBookings }}"
            label="Pembayaran Tertunda"
            accentColor="#f59e0b"
            iconBg="rgba(245, 158, 11, 0.15)" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <x-admin.action-card title="Shortcut" headerIcon="fas fa-bolt" headerIconColor="blue">
            <x-admin.action-item 
                url="{{ route('admin.qr-scanner') }}"
                icon="fas fa-qrcode"
                iconColor="blue"
                title="Scan QR Code"
                description="Verifikasi tiket"
                accentColor="#3b82f6" />
            
            <x-admin.action-item 
                url="{{ route('admin.movies.create') }}"
                icon="fas fa-plus"
                iconColor="green"
                title="Tambah Film"
                description="Perbanyak katalog"
                accentColor="#10b981" />
            
            <x-admin.action-item 
                url="{{ route('admin.schedules.create') }}"
                icon="fas fa-calendar-plus"
                iconColor="purple"
                title="Jadwal Baru"
                description="Rencanakan jadwal tayang"
                accentColor="#8b5cf6" />
        </x-admin.action-card>

        <div class="col-span-1 lg:col-span-2">
            <x-admin.action-card title="Performa hari ini" headerIcon="fas fa-calendar-day" headerIconColor="orange">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-admin.info-block 
                        icon="fas fa-ticket-alt"
                        iconColor="blue"
                        value="{{ $recentBookings->where('created_at', '>=', today())->count() }}"
                        label="Reservasi hari ini" />
                    
                    <x-admin.info-block 
                        icon="fas fa-money-bill-wave"
                        iconColor="green"
                        value="Rp {{ number_format($todayRevenue, 0, ',', '.') }}"
                        label="Pendapatan hari ini" />
                    
                    <x-admin.info-block 
                        icon="fas fa-couch"
                        iconColor="purple"
                        value="{{ $recentBookings->where('created_at', '>=', today())->where('status', 'paid')->sum(function($booking) {
                            return $booking->seats->count();
                        }) }}"
                        label="Kursi terjual" />
                </div>
            </x-admin.action-card>
        </div>
    </div>

    <x-admin.table-container 
        title="Booking Terbaru" 
        icon="fas fa-list" 
        iconColor="indigo"
        viewAllUrl="{{ route('admin.bookings.index') }}">
        
        <x-slot name="thead">
            <tr>
                <th>Pelanggan</th>
                <th>Film</th>
                <th>Bioskop</th>
                <th>Jadwal Tayang</th>
                <th>Kursi</th>
                <th>Status</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </x-slot>

        @forelse($recentBookings as $booking)
        <tr>
            <td>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white font-semibold text-sm">{{ substr($booking->customer_name, 0, 1) }}</span>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-white">{{ $booking->customer_name }}</div>
                        <div class="text-sm text-gray-400">{{ $booking->customer_phone }}</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="text-sm font-medium text-white">{{ $booking->schedule->movie->title }}</div>
                <div class="text-sm text-gray-400">{{ $booking->schedule->movie->duration_minutes }} menit</div>
            </td>
            <td>
                <div class="text-sm text-white">{{ $booking->schedule->studio->cinema->name }}</div>
                <div class="text-sm text-gray-400">{{ $booking->schedule->studio->name }}</div>
            </td>
            <td>
                <div class="text-sm text-white">{{ $booking->schedule->start_time->format('j M Y') }}</div>
                <div class="text-sm text-gray-400">{{ $booking->schedule->start_time->format('H:i') }}</div>
            </td>
            <td>
                <div class="flex flex-wrap gap-1">
                    @foreach($booking->seats as $seat)
                        <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded font-medium">
                            {{ $seat->row }}{{ $seat->number }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <x-admin.status-pill :status="$booking->status" />
            </td>
            <td>
                <div class="text-sm font-semibold text-white">
                    Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}
                </div>
            </td>
            <td>
                <div class="flex items-center space-x-2">
                    <button onclick="showBookingDetails('{{ $booking->unique_code }}')"
                            class="text-blue-400 hover:text-blue-300 p-2 hover:bg-gray-700 rounded-lg transition-colors"
                            title="View Details">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="scanQrCode('{{ $booking->unique_code }}')"
                            class="text-green-400 hover:text-green-300 p-2 hover:bg-gray-700 rounded-lg transition-colors"
                            title="View QR">
                        <i class="fas fa-qrcode"></i>
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <x-admin.empty-state 
            colspan="8"
            icon="fas fa-ticket-alt"
            title="Tidak ada booking terbaru"
            description="Booking baru akan muncul di sini" />
        @endforelse
    </x-admin.table-container>

    <x-modal id="bookingModal" title="Detail Reservasi" icon="fas fa-ticket-alt" closeFunction="closeBookingModal()">
        <div id="bookingDetails" class="space-y-4">
        </div>
    </x-modal>

    <x-slot name="scripts">
        <script>
        function showBookingDetails(uniqueCode) {
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
                    document.getElementById('bookingModal').classList.remove('hidden');
                } else {
                    alert('Booking not found');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error fetching booking details');
            });
        }

        function displayBookingDetails(booking) {
            const seatsHtml = booking.seats.map(seat => 
                `<span class="bg-gray-700 text-gray-300 text-xs px-3 py-1 rounded font-medium mr-1">${seat.row}${seat.number}</span>`
            ).join('');

            const detailsHtml = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="info-block">
                        <h4 class="font-semibold text-white mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-blue-400"></i>Informasi Pelanggan
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Nama:</span>
                                <span class="font-medium text-white">${booking.customer_name}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Nomor HP:</span>
                                <span class="font-medium text-white">${booking.customer_phone}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Kode:</span>
                                <span class="font-mono text-sm bg-gray-700 text-gray-300 px-2 py-1 rounded">${booking.unique_code}</span>
                            </div>
                        </div>
                    </div>
                    <div class="info-block">
                        <h4 class="font-semibold text-white mb-4 flex items-center">
                            <i class="fas fa-film mr-2 text-green-400"></i>Film & Jadwal
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Film:</span>
                                <span class="font-medium text-white">${booking.schedule.movie.title}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Bioskop:</span>
                                <span class="font-medium text-white">${booking.schedule.studio.cinema.name}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Ruangan:</span>
                                <span class="font-medium text-white">${booking.schedule.studio.name}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Jadwal:</span>
                                <span class="font-medium text-white">${new Date(booking.schedule.start_time).toLocaleString()}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 info-block">
                    <h4 class="font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-couch mr-2 text-purple-400"></i>Kursi & Pembayaran
                    </h4>
                    <div class="space-y-4">
                        <div>
                            <span class="text-gray-400 block mb-2">Kursi yang Dipilih:</span>
                            <div>${seatsHtml}</div>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-600">
                            <span class="text-gray-400">Total Harga:</span>
                            <span class="text-xl font-bold text-green-400">Rp ${(booking.schedule.price * booking.seats.length).toLocaleString('id-ID')}</span>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('bookingDetails').innerHTML = detailsHtml;
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }

        function scanQrCode(uniqueCode) {
            window.location.href = `{{ route('admin.qr-scanner') }}?code=${uniqueCode}`;
        }
        </script>
    </x-slot>
</x-admin.layout>