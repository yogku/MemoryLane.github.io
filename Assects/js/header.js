const profileIcon = document.querySelector('.profileIcon');
const toggleButton = document.querySelector('.toggleButton');
const sidebar = document.querySelector('.sidebar');

profileIcon.addEventListener('click', () => {
  alert('Profile icon clicked!');
  // Add profile icon click functionality here
});

toggleButton.addEventListener('click', () => {
  sidebar.classList.toggle('show');
});    

