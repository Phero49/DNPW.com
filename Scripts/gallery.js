document.addEventListener('DOMContentLoaded', () => {
  const slides = document.querySelectorAll('.slide');
  const next = document.querySelector('#next');
  const prev = document.querySelector('#prev');
  const auto = true;
  const intervalTime = 5000;
  let slideInterval;

  if (!next || !prev) {
      console.error('Next or Previous button not found in the DOM.');
      return;
  }

  if (slides.length === 0) {
      console.error('No slides found.');
      return;
  }

  if (!document.querySelector('.current')) {
      slides[0].classList.add('current');
  }

  const nextSlide = () => {
      const current = document.querySelector('.current');
      current.classList.remove('current');
      if (current.nextElementSibling) {
          current.nextElementSibling.classList.add('current');
      } else {
          slides[0].classList.add('current');
      }
  };

  const prevSlide = () => {
      const current = document.querySelector('.current');
      current.classList.remove('current');
      if (current.previousElementSibling) {
          current.previousElementSibling.classList.add('current');
      } else {
          slides[slides.length - 1].classList.add('current');
      }
  };

  next.addEventListener('click', () => {
      nextSlide();
      if (auto) {
          clearInterval(slideInterval);
          slideInterval = setInterval(nextSlide, intervalTime);
      }
  });

  prev.addEventListener('click', () => {
      prevSlide();
      if (auto) {
          clearInterval(slideInterval);
          slideInterval = setInterval(nextSlide, intervalTime);
      }
  });

  if (auto) {
      slideInterval = setInterval(nextSlide, intervalTime);
  }
});
