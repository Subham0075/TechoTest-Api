document.querySelectorAll('.faq-toggle').forEach(button => {
    button.addEventListener('click', () => {
      const card = button.parentElement;
      const content = card.querySelector('.faq-content');
  
      // Close all other open FAQs
      document.querySelectorAll('.faq-card').forEach(otherCard => {
        if (otherCard !== card) {
          otherCard.classList.remove('active');
        }
      });
  
      // Toggle this one
      card.classList.toggle('active');
    });
  });
  

  function startOfferCountdown() {
    const countdownEl = document.getElementById('offer-timer');
    let timeLeft = 3600; // 1 hour in seconds
  
    const timer = setInterval(() => {
      const hrs = String(Math.floor(timeLeft / 3600)).padStart(2, '0');
      const mins = String(Math.floor((timeLeft % 3600) / 60)).padStart(2, '0');
      const secs = String(timeLeft % 60).padStart(2, '0');
      countdownEl.textContent = `${hrs}:${mins}:${secs}`;
      timeLeft--;
  
      if (timeLeft < 0) {
        clearInterval(timer);
        countdownEl.textContent = "Expired";
      }
    }, 1000);
  }
  
  startOfferCountdown();
  
  