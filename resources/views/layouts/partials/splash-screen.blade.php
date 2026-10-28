<!-- Splash Screen Transition Overlay -->
<div id="page-splash-screen" class="splash-screen" aria-hidden="true" role="status" aria-label="Memuat halaman...">
    <div class="splash-backdrop"></div>
    <div class="splash-glow"></div>

    <div class="splash-content">
        <!-- Logo Emblem -->
        <div class="splash-logo-container">
            <!-- Animated outer orbit rings -->
            <div class="splash-ring splash-ring-orbit"></div>
            <div class="splash-ring splash-ring-pulse"></div>

            <!-- Badge TRM -->
            <div class="splash-badge">
                <span class="splash-badge-text">TRM</span>
            </div>
        </div>

        <!-- Brand Typography -->
        <div class="splash-brand">
            <h2 class="splash-brand-title">D-IV TEKNIK REKAYASA MULTIMEDIA</h2>
            <p class="splash-brand-sub">Politeknik Negeri Tanah Laut</p>
        </div>

        <!-- Equalizer / Multimedia Waves Animation -->
        <div class="splash-equalizer" aria-hidden="true">
            <span class="bar bar-1"></span>
            <span class="bar bar-2"></span>
            <span class="bar bar-3"></span>
            <span class="bar bar-4"></span>
            <span class="bar bar-5"></span>
        </div>

        <!-- Progress bar loader -->
        <div class="splash-progress-track">
            <div class="splash-progress-bar"></div>
        </div>

        <!-- Status caption -->
        <div class="splash-status">
            <span>Memuat halaman</span>
            <span class="splash-dots">
                <span>.</span><span>.</span><span>.</span>
            </span>
        </div>
    </div>
</div>

<style>
#page-splash-screen {
    position: fixed;
    inset: 0;
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
    opacity: 1;
    visibility: visible;
    transition: opacity 0.28s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.28s cubic-bezier(0.16, 1, 0.3, 1);
    pointer-events: auto;
    user-select: none;
    -webkit-user-select: none;
    overflow: hidden;
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
}

#page-splash-screen.splash-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

.splash-backdrop {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 45%, #ffffff 0%, #f8fafc 65%, #f1f5f9 100%);
}

.splash-glow {
    position: absolute;
    width: 22rem;
    height: 22rem;
    border-radius: 9999px;
    background: radial-gradient(circle, rgba(151, 215, 255, 0.32) 0%, rgba(77, 141, 186, 0.12) 42%, rgba(255, 255, 255, 0) 75%);
    filter: blur(36px);
    pointer-events: none;
    animation: splashGlowPulse 3s ease-in-out infinite;
}

.splash-content {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 1.5rem;
    z-index: 10;
}

.splash-logo-container {
    position: relative;
    width: 5.25rem;
    height: 5.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.25rem;
}

.splash-ring-orbit {
    position: absolute;
    inset: -6px;
    border-radius: 9999px;
    border: 2px dashed rgba(77, 141, 186, 0.45);
    animation: splashSpin 12s linear infinite;
}

.splash-ring-pulse {
    position: absolute;
    inset: -3px;
    border-radius: 9999px;
    border: 2px solid rgba(151, 215, 255, 0.6);
    animation: splashPing 2.2s cubic-bezier(0, 0, 0.2, 1) infinite;
}

.splash-badge {
    width: 4.75rem;
    height: 4.75rem;
    border-radius: 1.25rem;
    background: linear-gradient(135deg, #086288 0%, #064e6e 45%, #4D8DBA 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 12px 28px -5px rgba(8, 98, 136, 0.38), 0 8px 12px -6px rgba(8, 98, 136, 0.25);
    border: 3px solid #ffffff;
    animation: splashBadgeFloat 3s ease-in-out infinite;
}

.splash-badge-text {
    color: #ffffff;
    font-weight: 900;
    font-size: 1.35rem;
    letter-spacing: 0.05em;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

.splash-brand {
    margin-bottom: 1rem;
}

.splash-brand-title {
    font-size: 0.875rem;
    font-weight: 800;
    color: #243746;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    margin: 0 0 0.25rem 0;
    line-height: 1.2;
}

.splash-brand-sub {
    font-size: 0.72rem;
    font-weight: 600;
    color: #526777;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    margin: 0;
    line-height: 1.2;
}

.splash-equalizer {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    height: 22px;
    margin-bottom: 0.85rem;
}

.splash-equalizer .bar {
    width: 4px;
    border-radius: 9999px;
    animation: splashBarWave 1.2s ease-in-out infinite alternate;
}

.splash-equalizer .bar-1 { background-color: #086288; height: 10px; animation-delay: 0s; }
.splash-equalizer .bar-2 { background-color: #4D8DBA; height: 16px; animation-delay: 0.2s; }
.splash-equalizer .bar-3 { background-color: #97D7FF; height: 22px; animation-delay: 0.4s; }
.splash-equalizer .bar-4 { background-color: #4D8DBA; height: 16px; animation-delay: 0.6s; }
.splash-equalizer .bar-5 { background-color: #086288; height: 10px; animation-delay: 0.8s; }

.splash-progress-track {
    width: 10.5rem;
    height: 4px;
    background: #e2e8f0;
    border-radius: 9999px;
    overflow: hidden;
    position: relative;
    margin-bottom: 0.65rem;
}

.splash-progress-bar {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 45%;
    border-radius: 9999px;
    background: linear-gradient(90deg, #086288 0%, #4D8DBA 50%, #97D7FF 100%);
    animation: splashProgressBar 1.3s ease-in-out infinite;
}

.splash-status {
    font-size: 0.6875rem;
    font-weight: 600;
    color: #8397a7;
    letter-spacing: 0.04em;
    display: flex;
    align-items: center;
    gap: 1px;
}

.splash-dots span {
    animation: splashDotFade 1.4s infinite;
    opacity: 0;
}
.splash-dots span:nth-child(1) { animation-delay: 0.2s; }
.splash-dots span:nth-child(2) { animation-delay: 0.4s; }
.splash-dots span:nth-child(3) { animation-delay: 0.6s; }

@keyframes splashSpin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes splashGlowPulse {
    0%, 100% { transform: scale(0.95); opacity: 0.6; }
    50% { transform: scale(1.1); opacity: 1; }
}

@keyframes splashBadgeFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-4px); }
}

@keyframes splashBarWave {
    0% { transform: scaleY(0.4); opacity: 0.6; }
    100% { transform: scaleY(1); opacity: 1; }
}

@keyframes splashProgressBar {
    0% { left: -45%; }
    100% { left: 100%; }
}

@keyframes splashDotFade {
    0%, 100% { opacity: 0; }
    50% { opacity: 1; }
}

@keyframes splashPing {
    0% { transform: scale(1); opacity: 0.8; }
    75%, 100% { transform: scale(1.15); opacity: 0; }
}

@media (prefers-reduced-motion: reduce) {
    .splash-ring-orbit,
    .splash-ring-pulse,
    .splash-badge,
    .splash-equalizer .bar,
    .splash-progress-bar,
    .splash-dots span {
        animation: none !important;
    }
}
</style>

<script>
(function () {
    const SPLASH_ID = 'page-splash-screen';
    const MIN_LOAD_TIME = 220; // 220ms minimum visibility on initial page load for smooth experience
    const FADE_OUT_DURATION = 280; // duration in ms matching CSS transition
    const SAFETY_TIMEOUT = 5000; // safety fallback in case navigation is aborted

    const pageLoadStart = performance.now();
    let safetyTimer = null;

    function getSplash() {
        return document.getElementById(SPLASH_ID);
    }

    function hideSplashScreen(instant) {
        const splash = getSplash();
        if (!splash) return;

        clearTimeout(safetyTimer);

        if (instant) {
            splash.classList.add('splash-hidden');
            splash.style.display = 'none';
            return;
        }

        splash.classList.add('splash-hidden');
        setTimeout(() => {
            if (splash.classList.contains('splash-hidden')) {
                splash.style.display = 'none';
            }
        }, FADE_OUT_DURATION);
    }

    function showSplashScreen() {
        const splash = getSplash();
        if (!splash) return;

        splash.style.display = 'flex';
        // Force reflow
        void splash.offsetHeight;
        splash.classList.remove('splash-hidden');

        clearTimeout(safetyTimer);
        safetyTimer = setTimeout(() => {
            hideSplashScreen(false);
        }, SAFETY_TIMEOUT);
    }

    function dismissInitial() {
        const elapsed = performance.now() - pageLoadStart;
        const remainingDelay = Math.max(0, MIN_LOAD_TIME - elapsed);
        setTimeout(() => {
            hideSplashScreen(false);
        }, remainingDelay);
    }

    if (document.readyState === 'complete') {
        dismissInitial();
    } else {
        window.addEventListener('load', dismissInitial, { once: true });
    }

    // Support BFCache (Back/Forward Cache in modern browsers)
    window.addEventListener('pageshow', (event) => {
        hideSplashScreen(true);
    });

    // Safeguard: Pressing Escape hides splash screen if user gets stuck
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            hideSplashScreen(true);
        }
    });

    // Intercept clicks on links for page transitions
    document.addEventListener('click', (e) => {
        if (e.button !== 0) return;
        if (e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return;
        if (e.defaultPrevented) return;

        const anchor = e.target.closest('a');
        if (!anchor) return;

        if (anchor.target && anchor.target !== '_self') return;
        if (anchor.hasAttribute('download')) return;
        if (anchor.hasAttribute('data-no-splash') || anchor.classList.contains('no-splash')) return;

        const href = anchor.getAttribute('href');
        if (!href) return;

        if (
            href.startsWith('#') ||
            href.startsWith('javascript:') ||
            href.startsWith('mailto:') ||
            href.startsWith('tel:') ||
            href.startsWith('blob:')
        ) {
            return;
        }

        let destination;
        try {
            destination = new URL(anchor.href, window.location.href);
        } catch (_) {
            return;
        }

        if (destination.origin !== window.location.origin) {
            return;
        }

        if (
            destination.pathname === window.location.pathname &&
            destination.search === window.location.search
        ) {
            if (destination.hash) return;
        }

        showSplashScreen();
    }, true);

    // Intercept form submissions
    document.addEventListener('submit', (e) => {
        if (e.defaultPrevented) return;
        const form = e.target;
        if (form.target && form.target !== '_self') return;
        if (form.hasAttribute('data-no-splash') || form.classList.contains('no-splash')) return;

        showSplashScreen();
    }, true);

    // Expose API for programmatic triggers if needed
    window.TRMSplash = {
        show: showSplashScreen,
        hide: hideSplashScreen
    };
})();
</script>
