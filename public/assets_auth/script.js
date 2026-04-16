// Neumorphism Login Form JavaScript
class NeumorphismLoginForm {
    constructor() {
        this.form = document.getElementById('loginForm') || document.getElementById('registerForm');
        if (!this.form) return; // kalau dua2nya gak ada, berhenti
        this.emailInput = document.getElementById('email');
        this.passwordInput = document.getElementById('password');
        this.nameInput = document.getElementById('name');
        this.noTlpInput = document.getElementById('no_tlp');

        this.submitButton = this.form.querySelector('.login-btn');
        this.successMessage = document.getElementById('successMessage');
        this.socialButtons = document.querySelectorAll('.neu-social');

        this.init();
    }

    init() {
        this.bindEvents();
        this.setupPasswordToggle();
        this.setupSocialButtons();
        this.setupNeumorphicEffects();
    }

    bindEvents() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        this.emailInput.addEventListener('blur', () => this.validateEmail());
        this.passwordInput.addEventListener('blur', () => this.validatePassword());
        this.emailInput.addEventListener('input', () => this.clearError('email'));
        this.passwordInput.addEventListener('input', () => this.clearError('password'));
        if (this.nameInput) {
            this.nameInput.addEventListener('blur', () => this.validateName());
            this.nameInput.addEventListener('input', () => this.clearError('name'));
        }
        if (this.noTlpInput) {
            this.noTlpInput.addEventListener('blur', () => this.validateNoTlp());
            this.noTlpInput.addEventListener('input', () => this.clearError('no_tlp'));
        }



        // Add soft press effects to inputs
        [this.emailInput, this.passwordInput].forEach(input => {
            input.addEventListener('focus', (e) => this.addSoftPress(e));
            input.addEventListener('blur', (e) => this.removeSoftPress(e));
        });
    }

    setupPasswordToggle() {
        // ambil semua tombol toggle (bisa ada 0, 1, atau lebih)
        const toggles = this.form.querySelectorAll('.password-toggle');
        if (!toggles || toggles.length === 0) return;

        toggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                // cari input dalam grup yang sama
                const input = toggle.closest('.password-group')?.querySelector('input[type="password"], input[type="text"]');
                if (!input) return;

                const type = input.type === 'password' ? 'text' : 'password';
                input.type = type;

                // update ikon (jika ada)
                const eyeOpen = toggle.querySelector('.eye-open');
                const eyeClosed = toggle.querySelector('.eye-closed');
                if (eyeOpen && eyeClosed) {
                    if (type === 'text') {
                        eyeOpen.style.display = 'none';
                        eyeClosed.style.display = 'inline';
                    } else {
                        eyeOpen.style.display = 'inline';
                        eyeClosed.style.display = 'none';
                    }
                }

                // animasi lembut
                this.animateSoftPress(toggle);
            });
        });
    }

    setupSocialButtons() {
        this.socialButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                this.animateSoftPress(button);

                // Determine which social platform based on SVG content
                const svgPath = button.querySelector('svg path').getAttribute('d');
                let provider = 'Social';
                if (svgPath.includes('22.56')) provider = 'Google';
                else if (svgPath.includes('github')) provider = 'GitHub';
                else if (svgPath.includes('23.953')) provider = 'Twitter';

                this.handleSocialLogin(provider, button);
            });
        });
    }

    setupNeumorphicEffects() {
        // Add hover effects to all neumorphic elements
        const neuElements = document.querySelectorAll('.neu-icon, .neu-checkbox, .neu-social');
        neuElements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                element.style.transform = 'scale(1.05)';
            });

            element.addEventListener('mouseleave', () => {
                element.style.transform = 'scale(1)';
            });
        });

        // Add ambient light effect on mouse move
        document.addEventListener('mousemove', (e) => {
            this.updateAmbientLight(e);
        });
    }

    updateAmbientLight(e) {
        const card = document.querySelector('.login-card');
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const angleX = (x - centerX) / centerX;
        const angleY = (y - centerY) / centerY;

        const shadowX = angleX * 30;
        const shadowY = angleY * 30;

        card.style.boxShadow = `
            ${shadowX}px ${shadowY}px 60px #bec3cf,
            ${-shadowX}px ${-shadowY}px 60px #ffffff
        `;
    }

    addSoftPress(e) {
        const inputGroup = e.target.closest('.neu-input');
        inputGroup.style.transform = 'scale(0.98)';
    }

    removeSoftPress(e) {
        const inputGroup = e.target.closest('.neu-input');
        inputGroup.style.transform = 'scale(1)';
    }

    animateSoftPress(element) {
        element.style.transform = 'scale(0.95)';
        setTimeout(() => {
            element.style.transform = 'scale(1)';
        }, 150);
    }

    validateEmail() {
        const email = this.emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email) {
            this.showError('email', 'Email wajib diisi');
            return false;
        }

        if (!emailRegex.test(email)) {
            this.showError('email', 'Masukkan email yang valid');
            return false;
        }

        this.clearError('email');
        return true;
    }

    validatePassword() {
        const password = this.passwordInput.value;

        if (!password) {
            this.showError('password', 'Password wajib diisi');
            return false;
        }

        if (password.length < 6) {
            this.showError('password', 'Password harus terdiri dari minimal 6 karakter');
            return false;
        }

        this.clearError('password');
        return true;
    }

    validateName() {
        const name = this.nameInput.value;
        if (!name) {
            this.showError('name', 'Nama wajib diisi');
            return false;
        }
        this.clearError('name');
        return true;
    }

    validateNoTlp() {
        const noTlp = this.noTlpInput.value;
        if (!noTlp) {
            this.showError('no_tlp', 'No Telepon wajib diisi');
            return false;
        }

        const digitsOnly = noTlp.replace(/\D/g, '');
        if (digitsOnly.length < 10 || digitsOnly.length > 15) {
            this.showError('no_tlp', 'No Telepon harus 10–15 digit');
            return false;
        }
        if (!/^(\+62|0)\d{9,13}$/.test(noTlp)) {
            this.showError('no_tlp', 'Gunakan format nomor Indonesia, contoh: 081234567890 atau +6281234567890');
            return false;
        }

        // ✅ Jika lolos semua validasi
        this.clearError('no_tlp');
        return true;
    }



    showError(field, message) {
        const formGroup = document.getElementById(field).closest('.form-group');
        const errorElement = document.getElementById(`${field}Error`);

        formGroup.classList.add('error');
        errorElement.textContent = message;
        errorElement.classList.add('show');

        // Add gentle shake animation
        const input = document.getElementById(field);
        input.style.animation = 'gentleShake 0.5s ease-in-out';
        setTimeout(() => {
            input.style.animation = '';
        }, 500);
    }

    clearError(field) {
        const formGroup = document.getElementById(field).closest('.form-group');
        const errorElement = document.getElementById(`${field}Error`);

        formGroup.classList.remove('error');
        errorElement.classList.remove('show');
        setTimeout(() => {
            errorElement.textContent = '';
        }, 300);
    }

    async handleSubmit(e) {
        e.preventDefault();

        const isLogin = this.form.id === 'loginForm';
        const isRegister = this.form.id === 'registerForm';

        let valid = true;

        if (isLogin) {
            const emailOk = this.validateEmail();
            const passwordOk = this.validatePassword();
            valid = emailOk && passwordOk;
        }

        if (isRegister) {
            const nameOk = this.validateName();
            const emailOk = this.validateEmail();
            const passwordOk = this.validatePassword();
            const noTlpOk = this.validateNoTlp();
            valid = nameOk && emailOk && passwordOk && noTlpOk;
        }

        if (!valid) {
            this.animateSoftPress(this.submitButton);
            return;
        }

        this.setLoading(true);

        try {
            const formData = new FormData(this.form);
            const response = await fetch(this.form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            if (isLogin) {
                if (response.status === 401) {
                    this.showError('password', 'Email atau password salah');
                    this.showError('email', 'Email atau password salah');
                    return; //  stop, jangan lanjut ke success
                }

                if (!response.ok) {
                    this.showError('password', 'Login gagal. Silakan coba lagi.');
                    return;
                }
            }

            // Untuk register, tangani error validasi Laravel
            if (isRegister) {
                if (response.status === 422) {
                    const data = await response.json();
                    if (data.errors.email) this.showError('email', data.errors.email[0]);
                    if (data.errors.password) this.showError('password', data.errors.password[0]);
                    return;
                }

                if (!response.ok) {
                    this.showError('password', 'Registrasi gagal. Silakan coba lagi.');
                    return;
                }
            }

            // Jika lolos semua cek → success
            this.showNeumorphicSuccess();

        } catch (error) {
            console.error(error);
            this.showError('password', 'Registrasi gagal. Silakan coba lagi.');
        } finally {
            this.setLoading(false);
        }
    }


    async handleSocialLogin(provider, button) {
        console.log(`Initiating ${provider} login...`);

        // Add loading state to button
        button.style.pointerEvents = 'none';
        button.style.opacity = '0.7';

        try {
            await new Promise(resolve => setTimeout(resolve, 1500));
            console.log(`Redirecting to ${provider} authentication...`);
            // window.location.href = `/auth/${provider.toLowerCase()}`;
        } catch (error) {
            console.error(`${provider} authentication failed: ${error.message}`);
        } finally {
            button.style.pointerEvents = 'auto';
            button.style.opacity = '1';
        }
    }

    setLoading(loading) {
        this.submitButton.classList.toggle('loading', loading);
        this.submitButton.disabled = loading;

        // Disable social buttons during login
        this.socialButtons.forEach(button => {
            button.style.pointerEvents = loading ? 'none' : 'auto';
            button.style.opacity = loading ? '0.6' : '1';
        });
    }

    showNeumorphicSuccess() {
        // Soft fade out form
        this.form.style.transform = 'scale(0.95)';
        this.form.style.opacity = '0';

        setTimeout(() => {
            this.form.style.display = 'none';
            document.querySelector('.social-login').style.display = 'none';
            document.querySelector('.signup-link').style.display = 'none';

            // Show success with soft animation
            this.successMessage.classList.add('show');

            // Animate success icon
            const successIcon = this.successMessage.querySelector('.neu-icon');
            successIcon.style.animation = 'successPulse 0.6s ease-out';

        }, 300);

        // Simulate redirect
        setTimeout(() => {
            if (this.form.id === 'registerForm') {
                console.log('Redirecting to login...');
                window.location.href = '/login';
            } else if (this.form.id === 'loginForm') {
                console.log('Redirecting to seminar...');
                window.location.href = '/seminar';
            }
        }, 2000);
    }
}

// Add custom animations
if (!document.querySelector('#neu-keyframes')) {
    const style = document.createElement('style');
    style.id = 'neu-keyframes';
    style.textContent = `
        @keyframes gentleShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-3px); }
            75% { transform: translateX(3px); }
        }
        
        @keyframes successPulse {
            0% { transform: scale(0.8); opacity: 0; }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
}

// Initialize the form when DOM is loaded
window.addEventListener('load', () => {
    setTimeout(() => {
        const form = document.getElementById('loginForm') || document.getElementById('registerForm');
        if (form) new NeumorphismLoginForm();
        else console.warn('Form login/register tidak ditemukan di halaman ini.');
    }, 100); // delay kecil agar DOM benar-benar siap
});
