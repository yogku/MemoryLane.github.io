const sidebar = document.querySelector('.sidebar');
const sidebarButton = document.querySelector('.sidebarButton');
const profileIcon = document.querySelector('.profileIcon');

sidebarButton.addEventListener('click', () => {
  if (sidebar.style.left === '-250px') {
    sidebar.style.left = '0';
    sidebar.querySelectorAll('.sidebar-menu').forEach(menuItem => {
      menuItem.style.display = 'block';
    });
    sidebar.querySelectorAll('.sidebar-icon').forEach(icon => {
      icon.style.display = 'none';
    });
  } else {
    sidebar.style.left = '-250px';
    sidebar.querySelectorAll('.sidebar-menu').forEach(menuItem => {
      menuItem.style.display = 'none';
    });
    sidebar.querySelectorAll('.sidebar-icon').forEach(icon => {
      icon.style.display = 'block';
    });
  }
});

profileIcon.addEventListener('click', () => {
  alert('Profile icon clicked!');
  // Add your profile icon click functionality here
});