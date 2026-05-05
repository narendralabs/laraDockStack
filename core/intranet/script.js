document.addEventListener('DOMContentLoaded', () => {
  // Navigation active state handling
  const navItems = document.querySelectorAll('.nav-item');
  
  navItems.forEach(item => {
    item.addEventListener('click', (e) => {
      e.preventDefault();
      
      // Remove active class from all
      navItems.forEach(nav => nav.classList.remove('active'));
      
      // Add active class to clicked
      item.classList.add('active');
    });
  });

  // Refresh button animation
  const refreshBtn = document.getElementById('refresh-btn');
  if (refreshBtn) {
    refreshBtn.addEventListener('click', function() {
      const icon = this.querySelector('svg');
      // Add a quick rotation animation class
      icon.style.transition = 'transform 0.5s ease-in-out';
      icon.style.transform = `rotate(${360 * Math.random()}deg)`;
      
      // Reset after a bit to allow it to rotate again later
      setTimeout(() => {
        icon.style.transition = 'none';
        icon.style.transform = 'rotate(0deg)';
      }, 500);
      
      // We could also do a fetch to an API here if we convert this to PHP
    });
  }

  // Smooth appearance of cards
  const cards = document.querySelectorAll('.tool-card, .project-card');
  cards.forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    
    setTimeout(() => {
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
      
      // After intro animation completes, clear inline transition so CSS hover works
      setTimeout(() => {
        card.style.transition = '';
      }, 500);
      
    }, 100 * index);
  });
});
