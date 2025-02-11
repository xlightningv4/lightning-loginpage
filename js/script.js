document.addEventListener('DOMContentLoaded', () => {
    let slideIndex = 0;
    const slides = document.querySelectorAll('.hero-slider .slide');
    let autoSlideTimer;
  
    function showSlide(index) {
      slides.forEach(slide => slide.classList.remove('active'));
      slides[index].classList.add('active');
    }
  
    function nextSlide() {
      slideIndex = (slideIndex + 1) % slides.length;
      showSlide(slideIndex);
    }
  
    function prevSlide() {
      slideIndex = (slideIndex - 1 + slides.length) % slides.length;
      showSlide(slideIndex);
    }
  
    function startAutoSlide() {
      autoSlideTimer = setInterval(nextSlide, 5000); 
    }
  
    function resetAutoSlide() {
      clearInterval(autoSlideTimer);
      startAutoSlide();
    }
  
    showSlide(slideIndex);
    startAutoSlide();
  
    const nextBtn = document.querySelector('.slider-controls .next');
    const prevBtn = document.querySelector('.slider-controls .prev');
    nextBtn.addEventListener('click', () => {
      nextSlide();
      resetAutoSlide();
    });
    prevBtn.addEventListener('click', () => {
      prevSlide();
      resetAutoSlide();
    });
  
    const stats = document.querySelectorAll('.stat-item');
    const observerOptions = { threshold: 0.5 };
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, observerOptions);
    stats.forEach(stat => observer.observe(stat));
  
    const logoIcon = document.querySelector('.logo i');
    logoIcon.style.animation = 'float 3s ease-in-out infinite';
  });
  