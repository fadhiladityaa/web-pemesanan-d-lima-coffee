<footer class="bg-gray-900 text-white pt-16 mt-14 pb-8 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <!-- Brand & Description -->
            <div>
                <span class="font-bold text-3xl tracking-wide text-white">D'Lima Coffee</span>
                <p class="text-gray-400 text-base mt-2 mb-6">Crafting the perfect cup of coffee for your daily
                    inspiration.</p>

                <!-- WhatsApp Link -->
                <div class="mt-4">
                    <a href="https://wa.me/6281234567890?text=Halo%20D'Lima%20Coffee,%20saya%20mau%20tanya%20tentang%20produk%20kalian"
                        target="_blank"
                        class="inline-flex items-center gap-3 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-all duration-300">
                        <div class="w-6 h-6">
                            <!-- WhatsApp Logo - Ganti dengan gambar Anda -->
                            <img src="{{ asset('img/whatsapp-svgrepo-com.svg') }}" alt="WhatsApp" class="w-full h-full">
                        </div>
                        <span>Chat via WhatsApp</span>
                    </a>
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Our Location</h3>
                <div class="space-y-3 text-gray-400">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 mt-1">
                            <!-- Location Icon - Ganti dengan gambar Anda -->
                            <img src="{{ asset('img/location-pin-svgrepo-com.svg') }}" alt="Location" class="w-full h-full">
                        </div>
                        <div>
                            <p class="font-medium">D'Lima Coffee Main Store</p>
                            <p>Jl. Delima, Kompleks Islamic Center</p>
                            <p>Parepare, Sulawesi Selatan, 91111</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-4">
                        <div class="w-6 h-6">
                            <!-- Phone Icon - Ganti dengan gambar Anda -->
                            <img src="{{ asset('img/phone-call-svgrepo-com.svg') }}" alt="Phone" class="w-full h-full">
                        </div>
                        <div>
                            <p>+62 851-9489-0094</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Hours -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Opening Hours</h3>
                <div class="space-y-2 text-gray-400">
                    <div class="flex justify-between">
                        <span>Senin - Sabtu</span>
                        <span>6:30 - 17:30</span>
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">Follow Us</h3>
                    <div class="flex gap-4">
                        <a href="https://www.instagram.com/dlimacoffee?igsh=MTFjdDRlN3VkNGthNA==" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-white transition-all">
                            <div class="w-5 h-5">
                                <!-- Instagram Logo - Ganti dengan gambar Anda -->
                                <img src="{{ asset('img/instagram-167-svgrepo-com.svg') }}" alt="Instagram" class="w-full h-full">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 pt-8 text-center">
            <p class="text-gray-500 text-sm">© 2026 D'Lima Coffee. All rights reserved.</p>
        </div>
    </div>
</footer>
