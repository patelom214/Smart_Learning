<footer class="mt-5 pt-5 pb-4 bg-white border-top position-relative">
    
    <style>
        .footer-gradient-line {
            height: 4px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .footer-link {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .footer-link:hover {
            color: #667eea;
            transform: translateY(-2px);
        }

        .footer-social {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f3f2ef;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-size: 18px;
            transition: all 0.2s;
        }

        .footer-social:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: scale(1.1);
        }
    </style>

    <!-- top gradient line -->
    <div class="footer-gradient-line"></div>

    <div class="container text-center">

        <!-- Brand -->
        <h5 class="fw-bold text-primary mb-2">
            Smart Social Learning
        </h5>
        <p class="text-muted small mb-4">
            Learn • Share • Grow Together 🚀
        </p>

        <!-- Footer Links -->
        <div class="d-flex justify-content-center gap-4 mb-4 flex-wrap">
            <a href="{{ route('about') }}" class="footer-link">About</a>
            <a href="{{ route('contact') }}" class="footer-link">Contact</a>
            <a href="{{ route('privacy') }}" class="footer-link">Privacy</a>
            <a href="{{ route('terms') }}" class="footer-link">Terms</a>
        </div>

        <!-- Social Icons (optional) -->
        <div class="d-flex justify-content-center gap-3 mb-3">
            <a href="#" class="footer-social"><i class="bi bi-facebook"></i></a>
            <a href="#" class="footer-social"><i class="bi bi-twitter"></i></a>
            <a href="#" class="footer-social"><i class="bi bi-linkedin"></i></a>
        </div>

        <!-- Copyright -->
        <small class="text-muted">
            © {{ date('Y') }} Smart Learners. All rights reserved.
        </small>

    </div>
</footer>
