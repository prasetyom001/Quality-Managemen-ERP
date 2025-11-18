@extends('layouts.app')

@section('title', 'Tambah Material')

@section('content')
  <!-- Header Section -->
  <div class="mb-8">
    <div class="flex items-center space-x-3 mb-2">
      <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800">Tambah Material Baru</h2>
    </div>
    <p class="text-gray-600">Lengkapi form di bawah untuk menambahkan material ke dalam sistem</p>
  </div>

  <!-- Form Card -->
  <div class="max-w-2xl mx-auto">
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
      <div class="p-8">
        <form action="{{ route('materials.store') }}" method="POST" class="space-y-6">
          @csrf

          <!-- Nama Bahan Field -->
          <div class="space-y-2">
            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
              <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
              </svg>
              <span>Nama Bahan</span>
            </label>
            <input 
              type="text" 
              name="nama_bahan" 
              value="{{ old('nama_bahan') }}" 
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:bg-gray-100" 
              placeholder="Masukkan nama bahan material"
              required
            >
            @error('nama_bahan') 
              <div class="flex items-center space-x-2 text-red-600 text-sm mt-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $message }}</span>
              </div>
            @enderror
          </div>

          <!-- Kondisi Field -->
          <div class="space-y-2">
            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
              <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <span>Kondisi Material</span>
            </label>
            <div class="relative">
              <select 
                name="kondisi" 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:bg-gray-100 appearance-none cursor-pointer"
              >
                <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}> Baik</option>
                <option value="rusak" {{ old('kondisi') == 'rusak' ? 'selected' : '' }}> Rusak</option>
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </div>
            </div>
            @error('kondisi') 
              <div class="flex items-center space-x-2 text-red-600 text-sm mt-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $message }}</span>
              </div>
            @enderror
          </div>

          <!-- Jumlah Field -->
          <div class="space-y-2">
            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
              <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
              </svg>
              <span>Jumlah</span>
            </label>
            <div class="relative">
              <input 
                type="number" 
                name="jumlah" 
                value="{{ old('jumlah', 1) }}" 
                min="1" 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:bg-gray-100" 
                placeholder="Masukkan jumlah material"
                required
              >
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <span class="text-gray-400 text-sm">unit</span>
              </div>
            </div>
            @error('jumlah') 
              <div class="flex items-center space-x-2 text-red-600 text-sm mt-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $message }}</span>
              </div>
            @enderror
          </div>

          <!-- Action Buttons -->
          <div class="flex items-center justify-between pt-6 border-t border-gray-100">
            <a 
              href="{{ route('materials.index') }}" 
              class="flex items-center space-x-2 px-6 py-3 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-all duration-200 font-medium"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
              </svg>
              <span>Batal</span>
            </a>
            
            <button 
              type="submit"
              class="flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span>Simpan Material</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection