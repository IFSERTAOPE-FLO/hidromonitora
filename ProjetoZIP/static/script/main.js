(() => {
  const arrow = document.querySelector('#to-top');

  arrow.addEventListener('click', () => window.scrollTo(0, 0));

  addEventListener('scroll', () => {
    if (window.scrollY > 100) arrow.style.display = 'flex';
    else arrow.style.display = 'none';
  });
})();
