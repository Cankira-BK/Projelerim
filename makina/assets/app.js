// Performance Optimized JavaScript
(function() {
    'use strict';

    // ========== LAZY LOADING FOR IMAGES ==========
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            img.addEventListener('load', function() {
                this.classList.add('loaded');
            });
        });
    } else {
        // Fallback for older browsers
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
        document.body.appendChild(script);
    }

    // ========== INTERSECTION OBSERVER FOR ANIMATIONS ==========
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Animate elements on scroll
    const animateElements = document.querySelectorAll('.fade-in, .vehicle-card, .service-card, .badge-card');
    animateElements.forEach(el => {
        el.classList.add('fade-in');
        observer.observe(el);
    });

    // ========== HEADER SCROLL EFFECT ==========
    let lastScroll = 0;
    const header = document.querySelector('header');
    
    const handleScroll = () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    };

    // Throttle scroll event
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    // ========== SMOOTH SCROLL ==========
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // ========== PRELOAD CRITICAL RESOURCES ==========
    const preloadLinks = [
        { rel: 'preconnect', href: 'https://cdn.jsdelivr.net' },
        { rel: 'dns-prefetch', href: 'https://cdn.jsdelivr.net' }
    ];

    preloadLinks.forEach(link => {
        const linkElement = document.createElement('link');
        linkElement.rel = link.rel;
        linkElement.href = link.href;
        if (link.as) linkElement.as = link.as;
        if (link.crossorigin) linkElement.crossOrigin = link.crossorigin;
        document.head.appendChild(linkElement);
    });

    // ========== IMAGE LOADING OPTIMIZATION ==========
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });

    // ========== PERFORMANCE MONITORING ==========
    if ('PerformanceObserver' in window) {
        try {
            // Monitor Largest Contentful Paint
            const lcpObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                const lastEntry = entries[entries.length - 1];
                console.log('LCP:', lastEntry.renderTime || lastEntry.loadTime);
            });
            lcpObserver.observe({ entryTypes: ['largest-contentful-paint'] });

            // Monitor First Input Delay
            const fidObserver = new PerformanceObserver((list) => {
                list.getEntries().forEach(entry => {
                    console.log('FID:', entry.processingStart - entry.startTime);
                });
            });
            fidObserver.observe({ entryTypes: ['first-input'] });
        } catch (e) {
            // Silently fail if not supported
        }
    }

    // ========== REDUCE MOTION FOR ACCESSIBILITY ==========
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('*').forEach(el => {
            el.style.animation = 'none';
            el.style.transition = 'none';
        });
    }

    // ========== LOAD EXTERNAL SCRIPTS ASYNC ==========
    window.addEventListener('load', () => {
        // Defer non-critical scripts
        setTimeout(() => {
            // Load analytics or other third-party scripts here
            console.log('Page fully loaded and interactive');
        }, 1000);
    });

    // ========== CACHE STATIC ASSETS ==========
    if ('serviceWorker' in navigator && location.protocol === 'https:') {
        window.addEventListener('load', () => {
            // Register service worker for offline support
            // navigator.serviceWorker.register('/sw.js');
        });
    }

})();
