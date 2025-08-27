<div class="bg-gradient-to-r from-gray-900 via-blue-900 to-purple-900 text-white">
    <?php if(request()->route() && request()->route()->getName() !== 'penjelasan'): ?>
    <div class="max-w-3xl mx-auto px-4 py-6">
        <div class="bg-white rounded-xl shadow-lg p-6 grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <div class="md:col-span-2">
                <form id="referral-form" method="POST" action="<?php echo e(route('search.referral')); ?>" class="flex items-center gap-2">
                    <?php echo csrf_field(); ?>
                    <input id="referral-input" name="referral_code" type="text" value="<?php echo e(session('referral_name') ?? ''); ?>"
                        placeholder="Masukkan nama atau kode referral"
                        class="flex-1 px-4 py-3 rounded-lg border text-black border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    <button id="referral-btn" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">Cari</button>
                </form>
                <div id="referral-result" class="mt-3 hidden"></div>
            </div>
        </div>

        <?php if(session('referral_result')): ?>
        <div class="max-w-3xl mx-auto px-4 py-4 mt-2">
            <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-lg">
                <strong><?php echo e(session('referral_result.name')); ?></strong>
                <div class="text-sm">Phone: <?php echo e(session('referral_result.phone') ?? 'N/A'); ?></div>
                <div class="text-sm">Email: <?php echo e(session('referral_result.email') ?? 'N/A'); ?></div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="max-w-3xl mx-auto px-4 py-4 mt-2">
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg">
                <?php echo e(session('error')); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3
                        class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-4">
                        Iteracare
                    </h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Advanced Terahertz Technology for health and wellness. Experience the power of innovative
                        frequency therapy for your well-being.
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo e(route('home')); ?>"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Home</a></li>
                        <li><a href="<?php echo e(route('testimonials')); ?>"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Testimonials</a>
                        </li>
                        <li><a href="<?php echo e(route('contact')); ?>"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Contact</a></li>
                        <li><a href="<?php echo e(route('penjelasan')); ?>"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Penjelasan</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i>
                            <a href="mailto:info@iteracare.com" class="hover:underline">info@iteracare.com</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-blue-400"></i>
                            <a href="tel:+62811776230" class="hover:underline">+62 811-776-230</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-700 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © <?php echo e(date("Y")); ?> Iteracare. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Privacy
                        Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Terms of
                        Service</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Cookie
                        Policy</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function(){
        const input = document.getElementById('referral-input');
        const form = document.getElementById('referral-form');
        const resultBox = document.getElementById('referral-result');

        let timeout = null;

        function showResult(content, type = 'info'){
            resultBox.classList.remove('hidden');
            resultBox.innerHTML = content;
            resultBox.className = 'mt-3 p-3 rounded-lg';
            if(type === 'success'){
                resultBox.classList.add('bg-green-50', 'border', 'border-green-200', 'text-green-800');
            } else if(type === 'error'){
                resultBox.classList.add('bg-red-50', 'border', 'border-red-200', 'text-red-800');
            } else {
                resultBox.classList.add('bg-gray-50', 'border', 'border-gray-200', 'text-gray-800');
            }
        }

        // When user types outside the URL bar (input focused), search automatically after pause
        input.addEventListener('input', function(e){
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const val = input.value.trim();
                if(!val) {
                    resultBox.classList.add('hidden');
                    return;
                }

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ referral_code: val })
                }).then(async res => {
                    if(res.ok){
                        const data = await res.json();
                        if(data.found){
                            let html = `<strong>${data.referral.name}</strong><div class="text-sm">Phone: ${data.referral.phone ?? 'N/A'}</div><div class="text-sm">Email: ${data.referral.email ?? 'N/A'}</div>`;
                            if(data.wa){
                                html += `<div class="mt-2"><a href="${data.wa}" target="_blank" class="inline-flex items-center px-3 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600"><i class="fab fa-whatsapp mr-1"></i> Chat via WhatsApp</a></div>`;
                            }
                            showResult(html, 'success');
                        } else {
                            showResult('Tidak ditemukan sales representative dengan nama atau kode referral tersebut', 'error');
                        }
                    } else {
                        const err = await res.json().catch(()=>null);
                        showResult(err?.message || 'Terjadi kesalahan saat mencari referral', 'error');
                    }
                }).catch(() => {
                    showResult('Gagal terhubung ke server. Periksa koneksi Anda.', 'error');
                });
            }, 600);
        });

        // If user presses Enter in the input, proceed with normal form submission (preserve previous behavior)
        input.addEventListener('keydown', function(e){
            if(e.key === 'Enter'){
                e.preventDefault();
                form.submit();
            }
        });

    })();
</script>
<?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/partials/footer.blade.php ENDPATH**/ ?>