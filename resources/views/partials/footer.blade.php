<footer style="background:#1a1a2e; position:relative; overflow:hidden;">

    <style>
        /* ── Gradient top line ── */
        .footer-gradient-line {
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #ff5fa0, #667eea);
            background-size: 200% 100%;
            width: 100%;
            position: absolute;
            top: 0; left: 0;
            animation: shiftLine 4s linear infinite;
        }
        @keyframes shiftLine {
            0%   { background-position: 0% 0%; }
            100% { background-position: 200% 0%; }
        }

        /* ── Decorative bg blobs ── */
        .footer-blob1 {
            position: absolute; top: -80px; right: -80px;
            width: 300px; height: 300px; border-radius: 50%;
            background: radial-gradient(circle, rgba(102,126,234,.12) 0%, transparent 70%);
            pointer-events: none;
        }
        .footer-blob2 {
            position: absolute; bottom: -60px; left: -60px;
            width: 240px; height: 240px; border-radius: 50%;
            background: radial-gradient(circle, rgba(118,75,162,.1) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── Inner ── */
        .footer-inner {
            position: relative; z-index: 1;
            padding: 52px 0 32px;
            text-align: center;
        }

        /* Brand */
        .footer-brand {
            font-size: 20px; font-weight: 800;
            color: #fff; margin-bottom: 6px; letter-spacing: -.3px;
        }
        .footer-brand span { color: #667eea; }
        .footer-tagline {
            font-size: 13px; color: rgba(255,255,255,.45);
            margin-bottom: 36px; font-weight: 500;
        }

        /* Divider */
        .footer-divider {
            width: 48px; height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 99px;
            margin: 0 auto 32px;
        }

        /* Links */
        .footer-links {
            display: flex; justify-content: center;
            gap: 6px; flex-wrap: wrap; margin-bottom: 32px;
        }
        .footer-link {
            color: rgba(255,255,255,.5) !important;
            text-decoration: none !important;
            font-weight: 500; font-size: 13px;
            padding: 6px 14px; border-radius: 30px;
            border: 1px solid rgba(255,255,255,.08);
            transition: all .2s;
            display: inline-block;
        }
        .footer-link:hover {
            color: #fff !important;
            background: rgba(102,126,234,.2);
            border-color: rgba(102,126,234,.35);
            transform: translateY(-2px);
        }

        /* Social */
        .footer-socials {
            display: flex; justify-content: center;
            gap: 10px; margin-bottom: 36px;
        }
        .footer-social {
            width: 40px; height: 40px; border-radius: 12px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.1);
            display: inline-flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.6) !important;
            font-size: 17px;
            transition: all .2s;
            text-decoration: none !important;
        }
        .footer-social:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-color: transparent;
            color: #fff !important;
            transform: translateY(-3px) scale(1.08);
            box-shadow: 0 8px 20px rgba(102,126,234,.35);
        }

        /* Copyright */
        .footer-copy {
            font-size: 12px; color: rgba(255,255,255,.25);
            border-top: 1px solid rgba(255,255,255,.07);
            padding-top: 24px; margin-top: 4px;
        }
    </style>

    <!-- Animated top gradient line -->
    <div class="footer-gradient-line"></div>

    <!-- Background blobs -->
    <div class="footer-blob1"></div>
    <div class="footer-blob2"></div>

    <div class="container footer-inner">

        <!-- Brand -->
        <div class="footer-brand">Smart <span>Learn</span></div>
        <div class="footer-tagline">Learn • Share • Grow Together 🚀</div>

        <div class="footer-divider"></div>

        <!-- Links -->
        <div class="footer-links">
            <a href="{{ route('about') }}"   class="footer-link">About</a>
            <a href="{{ route('contact') }}" class="footer-link">Contact</a>
            <a href="{{ route('privacy') }}" class="footer-link">Privacy</a>
            <a href="{{ route('terms') }}"   class="footer-link">Terms</a>
        </div>

        <!-- Social Icons -->
        <div class="footer-socials">
            <a href="#" class="footer-social"><i class="bi bi-facebook"></i></a>
            <a href="#" class="footer-social"><i class="bi bi-twitter"></i></a>
            <a href="#" class="footer-social"><i class="bi bi-linkedin"></i></a>
        </div>

        <!-- Copyright -->
        <div class="footer-copy">
            © {{ date('Y') }} Smart Learners. All rights reserved.
        </div>

    </div>
</footer>