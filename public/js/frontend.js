/**
 * CMS Divisi & Prodi STIKES Panti Waluya
 * Frontend JavaScript Module
 */

// Configure Tailwind CSS
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
                        secondary: 'var(--color-secondary, #0369a1)',
                    },
                    brand: {
                        50: '#f0f9ff',
                        100: '#e0f2fe',
                        500: 'var(--color-primary, #0e7490)',
                        600: 'var(--color-primary, #0e7490)',
                        700: 'var(--color-secondary, #0369a1)',
                        800: '#075985',
                        900: '#0c4a6e',
                    }
                }
            }
        }
    };
}

// Global DOM Helper Scripts
document.addEventListener('DOMContentLoaded', function () {
    // Auto-dismiss alert notifications after 5 seconds
    const alerts = document.querySelectorAll('.flash-alert');
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
