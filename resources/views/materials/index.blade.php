@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex justify-end mb-4">
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button 
      class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg shadow hover:shadow-md">
      Logout
    </button>
  </form>
</div>

  <!-- Header -->
  <div class="mb-8">
    <div class="flex items-center space-x-3 mb-2">
      <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
        <x-heroicon-o-chart-bar class="w-5 h-5 text-white"/>
      </div>
      <h2 class="text-2xl font-bold text-gray-800">Dashboard Pemantauan</h2>
    </div>
    <p class="text-gray-600">Ringkasan data material dan kondisi inventory</p>
  </div>

  <!-- Statistik Cards -->
  <div class="grid md:grid-cols-3 gap-6 mb-8">
    @php
      $cards = [
        ['title' => 'Total Jumlah Bahan Baik','label' => 'BAIK','color' => 'green','value' => $total_baik,'count' => $count_baik],
        ['title' => 'Total Jumlah Bahan Rusak','label' => 'RUSAK','color' => 'red','value' => $total_rusak,'count' => $count_rusak],
        ['title' => 'Total Semua Bahan','label' => 'TOTAL','color' => 'blue','value' => $total_baik + $total_rusak,'count' => $materials->total()],
      ];
    @endphp

    @foreach($cards as $c)
      <div class="bg-white/80 rounded-2xl shadow p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
          <div class="w-12 h-12 bg-{{ $c['color'] }}-500 rounded-xl flex items-center justify-center text-white font-bold">
            {{ strtoupper(substr($c['label'], 0, 1)) }}
          </div>
          <div class="px-3 py-1 bg-{{ $c['color'] }}-100 text-{{ $c['color'] }}-800 rounded-full text-xs font-semibold">
            {{ $c['label'] }}
          </div>
        </div>
        <h3 class="text-sm font-medium text-gray-500 mb-1">{{ $c['title'] }}</h3>
        <p class="text-3xl font-bold text-{{ $c['color'] }}-600 mb-2">{{ number_format($c['value']) }}</p>
        <span class="text-xs text-gray-500">Item terhitung: {{ $c['count'] }}</span>
      </div>
    @endforeach
  </div>

  <!-- Chart -->
  <div class="bg-white/80 rounded-2xl shadow p-6 mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-2">Distribusi Kondisi Material</h3>
    <div class="h-64">
      <canvas id="kondisiChart"></canvas>
    </div>
  </div>

  <!-- Tabel Data -->
  <div class="bg-white/80 rounded-2xl shadow overflow-hidden">
    <div class="flex justify-between items-center p-4 border-b">
      <h2 class="text-lg font-bold text-gray-800">Daftar Material</h2>
      <a href="{{ route('materials.create') }}" 
         class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow hover:shadow-md">
        + Tambah
      </a>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Kondisi</th>
            <th class="px-4 py-2">Jumlah</th>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-center">
          @forelse($materials as $m)
            <tr class="border-t hover:bg-gray-50">
              <td class="px-4 py-2">{{ $loop->iteration + $materials->firstItem() - 1 }}</td>
              <td class="px-4 py-2">{{ $m->nama_bahan }}</td>
              <td class="px-4 py-2">
                <span class="px-2 py-1 rounded-full text-xs font-semibold
                  {{ $m->kondisi == 'baik' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                  {{ ucfirst($m->kondisi) }}
                </span>
              </td>
              <td class="px-4 py-2">{{ number_format($m->jumlah) }} unit</td>
              <td class="px-4 py-2">{{ optional($m->created_at)->format('d-m-Y H:i') ?? '-' }}</td>
              <td class="px-4 py-2 flex justify-center gap-2">
                <a href="{{ route('materials.edit', $m) }}" 
                   class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-md bg-amber-100 text-amber-700 hover:bg-amber-200">
                   <x-heroicon-o-pencil class="w-4 h-4 mr-1"/> Edit
                </a>
                <form action="{{ route('materials.destroy', $m) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                  @csrf @method('DELETE')
                  <button class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-md bg-red-100 text-red-700 hover:bg-red-200">
                      <x-heroicon-o-trash class="w-4 h-4 mr-1"/> Hapus
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center p-4 text-gray-500">Belum ada data</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="p-4 border-t">
      {{ $materials->links() }}
    </div>
  </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  new Chart(document.getElementById('kondisiChart'), {
    type: 'doughnut',
    data: {
      labels: ['Baik', 'Rusak'],
      datasets: [{
        data: [{{ $total_baik }}, {{ $total_rusak }}],
        backgroundColor: ['#22c55e', '#ef4444'],
      }]
    },
    options: { responsive: true, maintainAspectRatio: false }
  });
</script>
@endsection
