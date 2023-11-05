const profileIcon = document.querySelector('.profileIcon');

profileIcon.addEventListener('click', () => {
  alert('Profile icon clicked!');
  // Add profile icon click functionality here
});


//------------------------------------------------------------------
// post nav diaplay
//------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function() {
  const postIcon = document.getElementById('postIcon');
  const postNav = document.querySelector('.post-nav');

  let isHovering = false;

  postIcon.addEventListener('mouseenter', function() {
    isHovering = true;
    postNav.style.opacity = '1';
  });

  postIcon.addEventListener('mouseleave', function() {
    isHovering = false;
    setTimeout(function() {
      if (!isHovering) {
        postNav.style.opacity = '0';
      }
    }, 200); // Delay to allow time to move mouse from icon to nav
  });

  postNav.addEventListener('mouseenter', function() {
    isHovering = true;
  });

  postNav.addEventListener('mouseleave', function() {
    isHovering = false;
    setTimeout(function() {
      if (!isHovering) {
        postNav.style.opacity = '0';
      }
    }, 20); // Delay to allow time to move mouse from nav to icon
  });
});

// ----------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------
