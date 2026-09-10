<?php
// index.php
require_once 'includes/header.php';

// Fetch top 3 services
$stmt = $pdo->query("SELECT * FROM services ORDER BY sort_order ASC LIMIT 3");
$services = $stmt->fetchAll();

// Fetch top 4 projects
$projStmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT 4");
$projects = $projStmt->fetchAll();
?>

<!-- Hero Section Carousel -->
<section class="hero-section position-relative pb-5">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        
        <!-- Indicators -->
        <div class="carousel-indicators" style="bottom: -20px;">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <!-- Slide 1: Original -->
            <div class="carousel-item active">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6 hero-text-content mb-5 mb-lg-0">
                            <div class="hero-tags">
                                <span>IDEAS + TECHNOLOGY + INNOVATION</span>
                            </div>
                            <h1 class="hero-title">
                                Your Vision,<br>
                                Our <span class="highlight">Full Stack Solution</span>
                            </h1>
                            <p class="hero-desc">
                                We are a full-stack development company offering end-to-end digital solutions to help you build smarter, faster and better.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="service-web-app.php" class="btn-custom btn-primary-custom">Explore Web & App <i class="bi bi-arrow-right"></i></a>
                                <a href="contact.php" class="btn-custom btn-outline-custom">Get in Touch</a>
                            </div>
                        </div>
                        <div class="col-lg-6 hero-image-wrapper">
                            <div class="floating-badge badge-1">
                                <i class="bi bi-laptop text-info fs-4"></i>
                                <div class="fw-bold fs-6 lh-1">Web & App<br><small class="text-white-50 fw-normal">Development</small></div>
                            </div>
                            <img src="assets/images/web_app_hero.jpg" alt="Web and App Development" class="hero-img img-fluid" style="object-fit:cover; border-radius: 1rem; aspect-ratio: 4/3; width: 100%;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Construction -->
            <div class="carousel-item">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6 hero-text-content mb-5 mb-lg-0">
                            <div class="hero-tags">
                                <span>PLANNING + PRECISION + QUALITY</span>
                            </div>
                            <h1 class="hero-title">
                                Build With<br>
                                <span class="highlight text-warning">Total Confidence</span>
                            </h1>
                            <p class="hero-desc">
                                From cost planning to final delivery, our construction and QS professionals ensure your structural projects remain on budget and on time.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="service-construction-qs.php" class="btn-custom btn-primary-custom" style="background:var(--bs-warning); color:#000;">Explore Construction <i class="bi bi-arrow-right"></i></a>
                                <a href="contact.php" class="btn-custom btn-outline-custom">Get in Touch</a>
                            </div>
                        </div>
                        <div class="col-lg-6 hero-image-wrapper">
                            <div class="floating-badge badge-2">
                                <i class="bi bi-building text-warning fs-4"></i>
                                <div class="fw-bold fs-6 lh-1">Construction<br><small class="text-white-50 fw-normal">& QS</small></div>
                            </div>
                            <img src="assets/images/hero_bg.jpg" alt="Construction Management" class="hero-img img-fluid" style="object-fit:cover; border-radius: 1rem; aspect-ratio: 4/3; width: 100%;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: QA -->
            <div class="carousel-item">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6 hero-text-content mb-5 mb-lg-0">
                            <div class="hero-tags">
                                <span>TESTING + SECURITY + PERFORMANCE</span>
                            </div>
                            <h1 class="hero-title">
                                Flawless Execution,<br>
                                <span class="highlight text-success">Every Single Time</span>
                            </h1>
                            <p class="hero-desc">
                                Our dedicated QA teams meticulously test your software across all platforms to guarantee an exceptional, bug-free user experience.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="service-qa.php" class="btn-custom btn-primary-custom" style="background:var(--bs-success); color:#fff;">Explore QA Services <i class="bi bi-arrow-right"></i></a>
                                <a href="contact.php" class="btn-custom btn-outline-custom">Get in Touch</a>
                            </div>
                        </div>
                        <div class="col-lg-6 hero-image-wrapper">
                            <div class="floating-badge badge-3">
                                <i class="bi bi-shield-check text-success fs-4"></i>
                                <div class="fw-bold fs-6 lh-1">Quality<br><small class="text-white-50 fw-normal">Assurance</small></div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80" alt="Quality Assurance" class="hero-img img-fluid" style="object-fit:cover; border-radius: 1rem; aspect-ratio: 4/3; width: 100%;">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5" style="background-color: var(--surface);">
    <div class="container py-5">
        <div class="section-header">
            <div class="section-subtitle">— OUR SERVICES</div>
            <h2 class="section-title">Comprehensive Solutions for Your Success</h2>
            <p class="section-desc">From code to concrete, and from testing to trust — we deliver complete solutions tailored to your business needs.</p>
        </div>

        <div class="row g-4">
            <!-- Service 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card-new">
                    <div class="service-icon-wrapper icon-blue">
                        <i class="bi bi-code-slash"></i>
                    </div>
                    <h4>Web & App Development</h4>
                    <p>Modern, responsive and scalable web and mobile applications tailored to your business.</p>
                    <ul class="service-list">
                        <li>UI/UX Design</li>
                        <li>Front-end & Back-end Development</li>
                        <li>CMS & E-commerce Solutions</li>
                        <li>Cloud & Deployment</li>
                    </ul>
                    <a href="service-web-app.php" class="service-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card-new">
                    <div class="service-icon-wrapper icon-yellow">
                        <i class="bi bi-cone-striped"></i>
                    </div>
                    <h4>Construction & QS</h4>
                    <p>From planning to completion, we provide reliable construction and quantity surveying services with precision and quality.</p>
                    <ul class="service-list">
                        <li>Building Construction</li>
                        <li>Quantity Surveying (QS)</li>
                        <li>Map Drawing & Site Plans</li>
                        <li>Project Management</li>
                    </ul>
                    <a href="service-construction-qs.php" class="service-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card-new">
                    <div class="service-icon-wrapper icon-green">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>Quality Assurance</h4>
                    <p>Ensure your products and systems meet the highest standards with our testing and QA services.</p>
                    <ul class="service-list">
                        <li>Manual & Automated Testing</li>
                        <li>Performance Testing</li>
                        <li>Security Testing</li>
                        <li>Quality Consulting</li>
                    </ul>
                    <a href="service-qa.php" class="service-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-choose-us">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="section-subtitle text-info">— WHY CHOOSE US</div>
                <h2 class="section-title mb-4">Reasons to Work With Us</h2>
                <p class="text-white-50 mb-5">We combine technical expertise with industry experience to deliver high-quality, on-time and cost-effective solutions for your business.</p>
                <a href="about.php" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">Learn More <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="feature-box">
                            <div class="feature-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                            <div class="feature-content">
                                <h5>Experienced Team</h5>
                                <p>Skilled professionals in every domain.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-box">
                            <div class="feature-icon"><i class="bi bi-bullseye"></i></div>
                            <div class="feature-content">
                                <h5>End-to-End Service</h5>
                                <p>From planning to post-delivery support.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-box">
                            <div class="feature-icon"><i class="bi bi-shield-fill-check"></i></div>
                            <div class="feature-content">
                                <h5>Quality Focus</h5>
                                <p>We never compromise on quality.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-box">
                            <div class="feature-icon"><i class="bi bi-clock-fill"></i></div>
                            <div class="feature-content">
                                <h5>On-Time Delivery</h5>
                                <p>Your time matters. We deliver on schedule.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-box">
                            <div class="feature-icon"><i class="bi bi-people-fill"></i></div>
                            <div class="feature-content">
                                <h5>Client Centric</h5>
                                <p>Your success is our priority.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-box">
                            <div class="feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
                            <div class="feature-content">
                                <h5>Scalable Solutions</h5>
                                <p>Built for today, ready for tomorrow.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects -->
<section class="py-5" style="background-color: var(--background);">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <div class="section-subtitle">— OUR WORK</div>
                <h2 class="section-title mb-0">Featured Projects</h2>
                <p class="section-desc mx-0 mt-2">A glimpse of our recent work across development, construction and QA.</p>
            </div>
            <a href="portfolio.php" class="btn btn-link text-decoration-none fw-semibold d-none d-md-block">View All Projects <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row g-4">
            <!-- Project 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="project-card bg-white h-100">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                        <i class="bi bi-laptop display-1 text-primary opacity-50"></i>
                    </div>
                    <div class="p-4">
                        <span class="project-tag tag-blue mb-3 d-inline-block">Web Development</span>
                        <h5 class="fw-bold">E-commerce Platform</h5>
                        <p class="text-muted small mb-0">Custom e-commerce website with modern UI, secure payment integration and admin dashboard.</p>
                    </div>
                </div>
            </div>
            <!-- Project 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="project-card bg-white h-100">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                        <i class="bi bi-building display-1 text-warning opacity-50"></i>
                    </div>
                    <div class="p-4">
                        <span class="project-tag tag-yellow mb-3 d-inline-block">Construction & QS</span>
                        <h5 class="fw-bold">Residential Building Project</h5>
                        <p class="text-muted small mb-0">Full construction service with quantity surveying and detailed map drawings.</p>
                    </div>
                </div>
            </div>
            <!-- Project 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="project-card bg-white h-100">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                        <i class="bi bi-bug display-1 text-success opacity-50"></i>
                    </div>
                    <div class="p-4">
                        <span class="project-tag tag-green mb-3 d-inline-block">Quality Assurance</span>
                        <h5 class="fw-bold">Software Testing Solution</h5>
                        <p class="text-muted small mb-0">Functional, performance and security testing for a scalable web application.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4 d-md-none">
            <a href="portfolio.php" class="btn btn-outline-primary rounded-pill px-4 fw-semibold">View All Projects</a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0 text-center text-lg-start">
                <div class="section-subtitle text-info">— LET'S BUILD TOGETHER</div>
                <h2 class="fw-bold mb-2">Ready to Start Your Project?</h2>
                <p class="text-white-50 mb-0">Get in touch with us today and let's turn your ideas into reality.</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="contact.php" class="btn btn-light rounded-pill px-5 py-3 fw-bold text-dark shadow">Contact Us <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
