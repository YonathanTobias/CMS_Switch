/**
 * CMS Divisi & Prodi STIKES Panti Waluya
 * Admin JavaScript Module
 */

// Configure Tailwind CSS for Admin Panel
if (typeof tailwind !== 'undefined') {
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                },
                colors: {
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

// Global DOM Helper Scripts for Admin
document.addEventListener('DOMContentLoaded', function () {
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
