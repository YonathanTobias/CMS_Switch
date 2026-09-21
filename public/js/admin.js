/**
 * CMS Divisi & Prodi STIKES Panti Waluya
 * Admin JavaScript Module
 */

// Configure Tailwind CSS for Admin Panel
if (typeof tailwind !== 'undefined') {
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                fontFamily: {
                    sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                },
                colors: {
                    theme: {
                        primary: 'var(--color-primary, #0e7490)',
                    },
                    brand: {
                        500: 'var(--color-primary, #0e7490)',
                        600: 'var(--color-primary, #0e7490)',
                        700: 'var(--color-secondary, #0369a1)',
                    }
                }
            }
        }
    };
}

/**
 * Initialize Quill WYSIWYG Editor
 * @param {string} editorId - Element ID for editor container (e.g. '#editor')
 * @param {string} inputId - Hidden input ID for submitting HTML (e.g. '#contentInput')
 * @param {string} formId - Form ID (e.g. '#postForm')
 */
function initQuillEditor(editorId, inputId, formId) {
    if (!document.querySelector(editorId)) return null;

    const quill = new Quill(editorId, {
        theme: 'snow',
        placeholder: 'Tuliskan isi artikel / pengumuman secara rinci...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'blockquote', 'code-block'],
                ['clean']
            ]
        }
    });

    const form = document.querySelector(formId);
    const contentInput = document.querySelector(inputId);

    if (form && contentInput) {
        form.addEventListener('submit', function () {
            contentInput.value = quill.root.innerHTML;
        });
    }

    return quill;
}

/**
 * HTML5 Canvas API Client-Side Image Pre-Compressor
 * Automatically compresses large user images in memory before form submission.
 */
function initClientImageAutoCompressor() {
    const fileInputs = document.querySelectorAll('input[type="file"][accept*="image"]');

    fileInputs.forEach(input => {
        input.addEventListener('change', async function () {
            const file = this.files[0];
            if (!file || !file.type.startsWith('image/') || file.type === 'image/svg+xml') return;

            // Only compress if file is larger than 150KB
            if (file.size <= 150 * 1024) return;

            const originalSizeKb = (file.size / 1024).toFixed(1);

            try {
                const compressedBlob = await compressImageWithCanvas(file, 1600, 0.85);
                if (compressedBlob && compressedBlob.size < file.size) {
                    const compressedSizeKb = (compressedBlob.size / 1024).toFixed(1);
                    const savedPercent = Math.round((1 - compressedBlob.size / file.size) * 100);

                    // Create optimized File object
                    const newFileName = file.name.replace(/\.[^/.]+$/, "") + ".webp";
                    const newFile = new File([compressedBlob], newFileName, {
                        type: 'image/webp',
                        lastModified: Date.now()
                    });

                    // Assign optimized file to input
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(newFile);
                    this.files = dataTransfer.files;

                    // Show visual feedback badge next to the input
                    showCompressionNotice(this, originalSizeKb, compressedSizeKb, savedPercent);
                }
            } catch (err) {
                console.warn('Client-side compression skipped:', err);
            }
        });
    });
}

function compressImageWithCanvas(file, maxWidth = 1600, quality = 0.85) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (event) {
            const img = new Image();
            img.src = event.target.result;
            img.onload = function () {
                let width = img.width;
                let height = img.height;

                if (width > maxWidth) {
                    height = Math.round((height * maxWidth) / width);
                    width = maxWidth;
                }

                const canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;

                const ctx = canvas.getContext('2d');
                ctx.imageSmoothingEnabled = true;
                ctx.imageSmoothingQuality = 'high';
                ctx.drawImage(img, 0, 0, width, height);

                // Convert to WebP (or fallback to JPEG if WebP not supported)
                canvas.toBlob(blob => {
                    if (blob) {
                        resolve(blob);
                    } else {
                        canvas.toBlob(jpegBlob => resolve(jpegBlob), 'image/jpeg', quality);
                    }
                }, 'image/webp', quality);
            };
            img.onerror = err => reject(err);
        };
        reader.onerror = err => reject(err);
    });
}

function showCompressionNotice(inputEl, origKb, newKb, savedPct) {
    let badge = inputEl.parentElement.querySelector('.compression-badge');
    if (!badge) {
        badge = document.createElement('div');
        badge.className = 'compression-badge mt-2 text-[11px] font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-lg flex items-center space-x-1.5 inline-flex';
        inputEl.parentElement.appendChild(badge);
    }
    badge.innerHTML = `<i class="fa-solid fa-bolt text-emerald-500"></i> <span>Auto-Kompresi: <strong>${origKb} KB</strong> ➔ <strong>${newKb} KB</strong> (Hemat ${savedPct}%)</span>`;
}

// Global DOM Helper Scripts for Admin
document.addEventListener('DOMContentLoaded', function () {
    // Initialize HTML5 Canvas auto-compressor
    initClientImageAutoCompressor();

    // Auto-dismiss alert notifications after 5 seconds
    const alerts = document.querySelectorAll('.admin-flash-alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(function () {
                alert.remove();
            }, 500);
        }, 5000);
    });
});

